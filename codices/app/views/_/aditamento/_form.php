<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
//-
use common\models\Aditamento;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $aditamento \common\models\Aditamento */
/* @var $processo \common\models\Processo */

$form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]);
?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#geral" data-toggle="tab">Dados Gerais</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="geral">
            <?=
            $form->field($aditamento, 'numAditamento', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->textInput(['maxlength' => 5])
            ?>

            <?=
            $form->field($aditamento, 'dataAditamento', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'removeButton' => false,
                'language' => 'pt',
                'options' => ['placeholder' => '(automático)'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
            ?>

            <?=
            $form->field($aditamento, 'tipoVerba', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->dropDownList(Aditamento::listaTiposVerbasAditadas())
            ?>

            <?=
            $form->field($aditamento, 'tipoDocumento', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-xs-3'
                ]
            ])->dropDownList(Aditamento::listaTiposDocumento())
            ?>

            <?= $form->field($aditamento, 'louvado')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>
</div>

<section class="box box-default">
    <div class="box-body">
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

                <?= Html::a('Cancelar', Url::to(['aditamento/index', 'id' => $processo->id]), ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</section>

<?php
ActiveForm::end();
