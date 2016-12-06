<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$title = Yii::t('codices', 'New Series');
$btnCreate = Yii::t('codices', 'Add');
$btnClose = Yii::t('codices', 'Close');

Modal::begin([
    'id' => 'newseries',
    'header' => '<h4 class="model-title">' . $title . '</h4>',
    'footer' => '<button type="button" class="btn btn-success" onclick="codices.ajaxCreateSeries()">' . $btnCreate
    . '</button><button type="button" class="btn btn-primary" data-dismiss="modal">' . $btnClose . '</button>'
]);
?>

<?= Html::beginForm(Url::to(['series/ajax-create']), 'POST', ['role' => 'form']) ?>

<div class="container-fluid">
    <div class="row">
        <label class="col-xs-4 col-md-2 control-label"><?= Yii::t('codices', 'Name') ?></label>
        <div class="col-xs-8 col-md-10">
            <?= Html::textInput('Series[name]', null, ['class' => 'form-control', 'id' => 'series-name', 'maxlength' => 255]); ?>
        </div>
    </div>
</div>

<?= Html::endForm() ?>

<?php
Modal::end();
