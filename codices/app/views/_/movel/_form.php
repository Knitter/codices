<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\typeahead\Typeahead;
//-
use common\models\Aditamento;
use common\models\Categoria;
use common\models\Verba;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $formulario \app\models\forms\Movel */

$url = \Yii::$app->getUrlManager();
$processo = $formulario->processo;

$aditamentos = [0 => '- Sem Aditamento -'] + ArrayHelper::map(Aditamento::listaAditamentosProcessoComBMovel($processo->id), 'id', 'numAditamento');
$categorias = [0 => '- Sem Categoria -'] + ArrayHelper::map(Categoria::listaCategorias(), 'id', 'nome');
$estadosConservacao = [0 => '- Desconhecido -'] + Verba::listaEstadosConservacao();

$typeaheadBinds = '$("#credor1").bind("typeahead:selected", function(obj, datum, name) { $("#idCredor1").val(datum.id); });'
        . '$("#credor2").bind("typeahead:selected", function(obj, datum, name) { $("#idCredor2").val(datum.id); });'
        . '$("#credor3").bind("typeahead:selected", function(obj, datum, name) { $("#idCredor3").val(datum.id); });';

$this->registerJs($typeaheadBinds);
$this->registerJs('$(".trash-credor").click(function() { pgespro.clearLinhaCredor( this ); return false; });');
$this->registerJs("$('input[type=\"checkbox\"]').iCheck({ checkboxClass: 'icheckbox_minimal-red' });");

$this->registerCssFile($url->baseUrl . '/plugins/lightbox/lightbox.min.css');
$this->registerJsFile($url->baseUrl . '/plugins/lightbox/lightbox.min.js', ['depends' => 'yii\web\JqueryAsset']);

$anterior = $seguinte = $tipo1 = $tipo2 = false;
if ($formulario->movel) {
    list($anterior, $seguinte, $tipo1, $tipo2) = $formulario->verba->verbasVisinhas();
}

$form = ActiveForm::begin([
            'layout' => 'horizontal',
            'enableClientValidation' => false,
            'options' => ['enctype' => 'multipart/form-data']
        ]);
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#geral" data-toggle="tab">Dados Gerais</a></li>
        <li><a href="#onus" data-toggle="tab">Ónus/Credores</a></li>
        <li><a href="#valores" data-toggle="tab">Valores</a></li>
        <li><a href="#info" data-toggle="tab">Informação Venda</a></li>
        <li><a href="#fotos" data-toggle="tab">Fotografias</a></li>
        <?php if ($formulario->movel) { ?>
            <li class="pull-right">
                <a class="btn btn-default btn-xs text-muted <?= $seguinte ? '' : 'disabled' ?>" href="<?= $url->createUrl(['movel/update', 'id' => $seguinte]) ?>"><i class="fa fa-chevron-right"> </i></a>
            </li>
            <li class="pull-right">
                <a class="btn btn-default btn-xs text-muted <?= $anterior ? '' : 'disabled' ?>" href="<?= $url->createUrl(['movel/update', 'id' => $anterior]) ?>"><i class="fa fa-chevron-left"> </i></a>
            </li>
        <?php } ?>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="geral">
            <?=
            $form->field($formulario, 'numeroVerba', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput([
                'maxlength' => 25,
                'placeholder' => '(automático)']
            )
            ?>

            <?=
            $form->field($formulario, 'idAditamento', [
                'inputTemplate' => '<div class="input-group">{input}<a href="#modal-aditamento" class="input-group-addon" data-toggle="modal"><i class="fa fa-plus"></i></a></div>',
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->dropDownList($aditamentos)
            ?>

            <?=
            $form->field($formulario, 'idCategoria', [
                'inputTemplate' => '<div class="input-group">{input}<a href="#modal-categoria" class="input-group-addon" data-toggle="modal"><i class="fa fa-plus"></i></a></div>',
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->dropDownList($categorias)
            ?>

            <?= $form->field($formulario, 'descricao')->textarea(['rows' => 3]) ?>

            <?= $form->field($formulario, 'localizacao')->textInput(['maxlength' => 255]) ?>

            <?=
            $form->field($formulario, 'estadoConservacao', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->dropDownList($estadosConservacao);
            ?>

            <?=
            $form->field($formulario, 'numeroSerie', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput(['maxlength' => 255])
            ?>

            <?=
            $form->field($formulario, 'numeroHoras', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput()
            ?>

            <?=
            $form->field($formulario, 'iva', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-2'
                ]
            ])->textInput()
            ?>

            <?= $form->field($formulario, 'localizacaoChaves')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($formulario, 'apreensaoPlenaCIRE')->checkbox() ?>

            <?= $form->field($formulario, 'excluida')->checkbox() ?>

            <?php
            $opcoes = [];
            if ($formulario->movel && (count($formulario->movel->verba->loteamentos) > 0)) {
                $opcoes = ['disabled' => 'disabled'];
            }

            echo $form->field($formulario, 'terceiros')->checkbox($opcoes),
            $form->field($formulario, 'titularTerceiro')->textInput(['maxlength' => 255, 'placeholder' => 'Válido apenas com a opção acima seleccionada'] + $opcoes);
            ?>

            <?= $form->field($formulario, 'observacoes')->textarea(['rows' => 3]) ?>
        </div>

        <div class="tab-pane" id="onus">
            <?= $form->field($formulario, 'locador')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($formulario, 'onus')->textInput() ?>

            <div class="form-group">
                <label class="control-label col-xs-3"><?= $formulario->attributeLabels()['idCredor1']; ?></label>
                <div class="col-xs-6">
                    <div class="input-group">
                        <?=
                        Typeahead::widget([
                            'id' => 'credor1',
                            'name' => 'credor1',
                            'value' => $formulario->idCredor1 ? $formulario->nomeCredor1 : '',
                            'scrollable' => true,
                            'pluginOptions' => ['highlight' => true],
                            'dataset' => [
                                [
                                    'display' => 'value',
                                    'remote' => [
                                        'url' => Url::to(['entidade/typeahead']) . '?q=%QUERY',
                                        'wildcard' => '%QUERY'
                                    ],
                                    'limit' => 25
                                ]
                            ]
                        ]);
                        ?>
                        <a href="#" data-numero="1" class="input-group-addon trash-credor"><i class="fa fa-trash-o"></i></a>
                        <a href="#modal-credor1" class="input-group-addon" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3"><?= $formulario->attributeLabels()['idCredor2']; ?></label>
                <div class="col-xs-6">
                    <div class="input-group">
                        <?=
                        Typeahead::widget([
                            'id' => 'credor2',
                            'name' => 'credor2',
                            'value' => $formulario->idCredor2 ? $formulario->nomeCredor2 : '',
                            'scrollable' => true,
                            'pluginOptions' => ['highlight' => true],
                            'dataset' => [
                                [
                                    'display' => 'value',
                                    'remote' => [
                                        'url' => Url::to(['entidade/typeahead']) . '?q=%QUERY',
                                        'wildcard' => '%QUERY'
                                    ],
                                    'limit' => 25
                                ]
                            ]
                        ]);
                        ?>
                        <a href="#" data-numero="2" class="input-group-addon trash-credor"><i class="fa fa-trash-o"></i></a>
                        <a href="#modal-credor2" class="input-group-addon" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3"><?= $formulario->attributeLabels()['idCredor3']; ?></label>
                <div class="col-xs-6">
                    <div class="input-group">
                        <?=
                        Typeahead::widget([
                            'id' => 'credor3',
                            'name' => 'credor3',
                            'value' => $formulario->idCredor3 ? $formulario->nomeCredor3 : '',
                            'scrollable' => true,
                            'pluginOptions' => ['highlight' => true],
                            'dataset' => [
                                [
                                    'display' => 'value',
                                    'remote' => [
                                        'url' => Url::to(['entidade/typeahead']) . '?q=%QUERY',
                                        'wildcard' => '%QUERY'
                                    ], 'limit' => 25
                                ]
                            ]
                        ]);
                        ?>
                        <a href="#" data-numero="3" class="input-group-addon trash-credor"><i class="fa fa-trash-o"></i></a>
                        <a href="#modal-credor3" class="input-group-addon" data-toggle="modal"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="valores">
            <?=
            $form->field($formulario, 'valorLiquidacao', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">&euro;</span></div>',
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput(['maxlength' => 16])
            ?>

            <?=
            $form->field($formulario, 'valorContinuidade', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">&euro;</span></div>',
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput(['maxlength' => 16])
            ?>
        </div>

        <div class="tab-pane" id="info">
            <?=
            $form->field($formulario, 'latitude', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput(['maxlength' => 50])
            ?>

            <?=
            $form->field($formulario, 'longitude', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput(['maxlength' => 50])
            ?>

            <?= $form->field($formulario, 'localizacaoVenda')->textInput() ?>

            <?= $form->field($formulario, 'notaSite')->textInput() ?>
        </div>

        <div class="tab-pane" id="fotos">
            <?=
            $form->field($formulario, 'fotografias[]')->widget(FileInput::className(), [
                'options' => [
                    'multiple' => true
                ],
                'pluginOptions' => [
                    'browseClass' => 'btn btn-info',
                    'showPreview' => false,
                    'showUpload' => false,
                    'browseLabel' => ''
                ]
            ])
            ?>

            <?php
            if ($formulario->movel) {
                $fotografias = $formulario->movel->verba->getFotos()->orderBy('ordem')->all();
                if (count($fotografias) > 0) {
                    $js = '$("a.trash" ).click(function() { pgespro.removeFotografiaVerba( this, "Movel"); });'
                            . sprintf('$("input.visivel-site").on("ifChanged", function() { pgespro.toggleVisibilidadeFotografia(this, "%s" ); });', $url->createUrl(['foto/ajax-visibilidade-site']))
                            . sprintf('$("input.visivel-catalogo").on("ifChanged", function() { pgespro.toggleVisibilidadeFotografia(this, "%s" ); });', $url->createUrl(['foto/ajax-visibilidade-catalogo']))
                            . sprintf('$("input.visivel-documentos").on("ifChanged", function() { pgespro.toggleVisibilidadeFotografia(this, "%s" ); });', $url->createUrl(['foto/ajax-visibilidade-documentos']))
                            . sprintf('$(".sortable-box" ).sortable({stop: function( event, ui ) { pgespro.sortFotografias("%s"); }});', $url->createUrl(['foto/ajax-sort']));

                    $this->registerJs($js);
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Fotografias</h4>
                        </div>
                        <div class="galeria">
                            <ul class="sortable-box">
                                <?php foreach ($fotografias as $foto) { ?>
                                    <li id="bloco-<?= $foto->id ?>" class="bloco-imagem" data-id="<?= $foto->id ?>">
                                        <a href="<?= $url->createUrl(['foto/versao-privada', 'id' => $foto->id]) ?>" data-lightbox="fotos">
                                            <img class="img-responsive" src="<?= $url->createUrl(['foto/versao-privada', 'id' => $foto->id]) ?>" alt="Foto nr. <?= $foto->ordem ?> do bem móvel.">
                                        </a>

                                        <div class="opcoes">
                                            <span>Usar em:</span><br />
                                            <input class="visivel-site" type="checkbox" data-id="<?= $foto->id ?>" <?= $foto->visivelSite ? 'checked="checked"' : '' ?> /> Website<br />
                                            <input class="visivel-catalogo" type="checkbox" data-id="<?= $foto->id ?>" <?= $foto->visivelCatalogo ? 'checked="checked"' : '' ?>/> Catálogo<br />
                                            <input class="visivel-documentos" type="checkbox" data-id="<?= $foto->id ?>" <?= $foto->visivelDocumentos ? 'checked="checked"' : '' ?> /> Documentos
                                            <a class="btn btn-danger btn-xs pull-right trash" data-thumb="<?= $foto->id ?>"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<section class="box box-default">
    <div class="box-body">
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

                <?= Html::a('Cancelar', $url->createUrl(['movel/index', 'id' => $processo->id]), ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</section>

<!-- Contentor para ID das imagens a remover -->
<div id="trash-imagens" style="display: none; height: 0; width: 0;"></div>

<?php
echo Html::input('hidden', 'Movel[idCredor1]', $formulario->idCredor1, ['id' => 'idCredor1']),
 Html::input('hidden', 'Movel[idCredor2]', $formulario->idCredor2, ['id' => 'idCredor2']),
 Html::input('hidden', 'Movel[idCredor3]', $formulario->idCredor3, ['id' => 'idCredor3']);

ActiveForm::end();

echo $this->render('/processo/_modal-credor', [
    'modal' => 'modal-credor1',
    'id' => 'idCredor1',
    'nome' => 'credor1'
]),
 $this->render('/processo/_modal-credor', [
    'modal' => 'modal-credor2',
    'id' => 'idCredor2',
    'nome' => 'credor2'
]),
 $this->render('/processo/_modal-credor', [
    'modal' => 'modal-credor3',
    'id' => 'idCredor3',
    'nome' => 'credor3'
]),
 $this->render('_modal-categoria'),
 $this->render('/aditamento/_modal-aditamento', [
    'processo' => $processo,
    'tipoVerba' => Aditamento::TIPO_VERBA_ADITADA_MOVEL,
    'field' => 'movel-idaditamento'
]);
