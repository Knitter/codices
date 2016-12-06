<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$title = Yii::t('codices', 'New Author');
$btnCreate = Yii::t('codices', 'Add');
$btnClose = Yii::t('codices', 'Close');

Modal::begin([
    'id' => 'newauthor',
    'header' => '<h4 class="model-title">' . $title . '</h4>',
    'footer' => '<button type="button" class="btn btn-success" onclick="codices.ajaxCreateAuthor()">' . $btnCreate
    . '</button><button type="button" class="btn btn-primary" data-dismiss="modal">' . $btnClose . '</button>'
]);
?>

<?= Html::beginForm(Url::to(['authors/ajax-create']), 'POST', ['role' => 'form']) ?>

<div class="container-fluid">
    <div class="row">
        <label class="col-xs-4 col-md-2 control-label"><?= Yii::t('codices', 'Name') ?></label>
        <div class="col-xs-8 col-md-10">
            <?= Html::textInput('Author[name]', null, ['class' => 'form-control', 'id' => 'author-name', 'maxlength' => 255]); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-xs-4 col-md-2 control-label"><?= Yii::t('codices', 'Surname') ?></label>
        <div class="col-xs-8 col-md-10">
            <?= Html::textInput('Author[surname]', null, ['class' => 'form-control', 'id' => 'author-surname', 'maxlength' => 255]); ?>
        </div>
    </div>
</div>

<?= Html::endForm() ?>

<?php
Modal::end();
