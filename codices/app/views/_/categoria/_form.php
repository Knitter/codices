<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $categoria common\models\Categoria */

$url = \Yii::$app->getUrlManager();

$form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]);
?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#geral" data-toggle="tab">Dados Gerais</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="geral">
            <?= $form->field($categoria, 'nome')->textInput(['maxlength' => 255]) ?>
        </div>
    </div>
</div>

<section class="box box-default">
    <div class="box-body">
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

                <?= Html::a('Cancelar', $url->createUrl(['categoria/index']), ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</section>

<?php
ActiveForm::end();
