<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
//-
use common\models\Franchisado;

/* @var $this yii\web\View */
/* @var $formulario app\models\forms\Colaborador */
/* @var $form yii\bootstrap\ActiveForm */

$grupos = [];
foreach(Franchisado::find()->orderBy('nome')->all() as $franchisado) {
    $grupos[$franchisado->id] = $franchisado->nome;
}

$this->registerJs("$('input[type=\"checkbox\"]').iCheck({ checkboxClass: 'icheckbox_minimal-red' });");

$form = ActiveForm::begin([
            'layout' => 'horizontal',
            'enableClientValidation' => false,
            'options' => ['enctype' => 'multipart/form-data']
        ]);
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#geral" data-toggle="tab">Dados Gerais</a></li>
        <li><a href="#acesso" data-toggle="tab">Dados de Acesso</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="geral">
            <?= $form->field($formulario, 'nome')->textInput(['maxlength' => 100]) ?>

            <?=
            $form->field($formulario, 'telemovel', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput(['maxlength' => 15])
            ?>

            <?=
            $form->field($formulario, 'iniciais', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-2'
                ]
            ])->textInput(['maxlength' => 5])
            ?>

            <?=
            $form->field($formulario, 'registos', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-2'
                ]
            ])->dropDownList([25 => 25, 50 => 50, 100 => 100, 150 => 150, 200 => 200])
            ?>

            <?= $form->field($formulario, 'administrador')->checkbox() ?>

            <?= $form->field($formulario, 'genero')->radioList(\common\models\Colaborador::listaGeneros()) ?>

            <div class="form-group">
                <label class="control-label col-xs-3"><?= $formulario->attributeLabels()['foto']; ?></label>
                <div class="col-xs-6">
                    <div class="input-group">
                        <?=
                        FileInput::widget([
                            'model' => $formulario,
                            'attribute' => 'foto',
                            'pluginOptions' => [
                                'browseClass' => 'btn btn-info',
                                'showPreview' => false,
                                'showUpload' => false,
                                'browseLabel' => ''
                            ]
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="acesso">            
            <?= $form->field($formulario, 'email')->textInput(['maxlength' => 255]) ?>

            <?=
            $form->field($formulario, 'password', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-4'
                ]
            ])->passwordInput(['placeholder' => 'Vazio para não alterar'])
            ?>

            <?= $form->field($formulario, 'activa')->checkbox() ?>

            <?=
            $form->field($formulario, 'tentativas', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-2'
                ]
            ])->textInput()
            ?>
            
            <?= $form->field($formulario, 'grupos')->checkboxList($grupos) ?>
        </div>
    </div>
</div>

<section class="box box-default">
    <div class="box-body">
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

                <?= Html::a('Cancelar', Url::to(['colaborador/index']), ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</section>

<?php
ActiveForm::end();

