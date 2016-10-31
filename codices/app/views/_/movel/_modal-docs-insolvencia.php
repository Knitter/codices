<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
//-
use common\models\Aditamento;

/* @var $this yii\web\View */
/* @var $processo common\models\Processo */

$aditamentos = Aditamento::listaAditamentosProcessoComBMovel($processo->id);
$count = count($aditamentos);

if ($count) {
    $closure = function($aditamento) {
        return $aditamento->numAditamento . ' - ' . $aditamento->dataAditamento . '/' . $aditamento->labelTipoVerbaAditada();
    };

    $aditamentos = [0 => '- Verbas Sem Aditamento -'] + ArrayHelper::map($aditamentos, 'id', $closure);
}

$urlAutoArrolamento = Url::to(['movel/auto-arrolamento', 'id' => $processo->id]);
$urlAutoApreensao = Url::to(['movel/auto-apreensao', 'id' => $processo->id]);
$urlInventario = Url::to(['movel/inventario', 'id' => $processo->id]);
$urlRRA = Url::to(['viatura/requerimento-registo-automovel', 'id' => $processo->id]);
$urlMapaViaturas = Url::to(['viatura/mapa-viaturas-apreendidas', 'id' => $processo->id]);

Modal::begin([
    'id' => 'modal-docs-moveis',
    'header' => '<h4 class="model-title">Documentos de Bens Móveis</h4>',
    'footer' => '<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>'
]);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-4">Aditamento</div>
        <div class="col-xs-8">
            <?= Html::dropDownList('lstAditamento', null, $aditamentos, ['class' => 'form-control', 'id' => 'lstAditamento']); ?>
        </div>
    </div>

    <?php if (empty($processo->processoJudicial->processoInsolvencia->dataArrolmBMovel)) { ?>
        <div class="row data-arrolamento-row" style="margin-top: 10px;">
            <div class="col-xs-4">Data de Arrolamento</div>
            <div class="col-xs-5">
                <?=
                DatePicker::widget([
                    'name' => 'data-arrolamento',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'removeButton' => false,
                    'language' => 'pt',
                    'options' => ['class' => 'data-arrolamento'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
                ?>
            </div>
        </div>
    <?php } ?>

    <?php if (empty($processo->processoJudicial->processoInsolvencia->dataApreensaoBMovel)) { ?>
        <div class="row data-apreensao-row" style="margin-top: 10px;">
            <div class="col-xs-4">Data de Apreensão</div>
            <div class="col-xs-5">
                <?=
                DatePicker::widget([
                    'name' => 'data-apreensao',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'removeButton' => false,
                    'language' => 'pt',
                    'options' => ['class' => 'data-apreensao'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
                ?>
            </div>
        </div>
    <?php } ?>

    <?php if (empty($processo->processoJudicial->processoInsolvencia->dataInventarioBMovel)) { ?>
        <div class="row data-inventario-row" style="margin-top: 10px;">
            <div class="col-xs-4">Data de Inventário</div>
            <div class="col-xs-5">
                <?=
                DatePicker::widget([
                    'name' => 'data-inventario',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'removeButton' => false,
                    'language' => 'pt',
                    'options' => ['class' => 'data-inventario'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
                ?>
            </div>
        </div>
    <?php } ?>

    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-11 col-xs-offset-1">
            <a class="btn btn-app docs" href="<?= $urlAutoArrolamento ?>" data-url="<?= $urlAutoArrolamento ?>">
                <i class="fa fa-file-pdf-o"></i>
                Arrolamento
            </a>

            <a class="btn btn-app docs" href="<?= $urlAutoApreensao ?>" data-url="<?= $urlAutoApreensao ?>">
                <i class="fa fa-file-pdf-o"></i>
                Apreensão
            </a>

            <a class="btn btn-app docs" href="<?= $urlInventario ?>" data-url="<?= $urlInventario ?>">
                <i class="fa fa-file-pdf-o"></i>
                Inventário
            </a>

            <a class="btn btn-app docs" href="<?= $urlRRA ?>" data-url="<?= $urlRRA ?>" target="_blank">
                <i class="fa fa-file-pdf-o"></i>
                RRA
            </a>

            <a class="btn btn-app" href="<?= $urlMapaViaturas ?>" target="_blank">
                <i class="fa fa-file-pdf-o"></i>
                Mapa Viaturas
            </a>
        </div>
    </div>
</div>

<?php
Modal::end();
