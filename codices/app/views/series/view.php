<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $series \common\models\Series */

$this->title = 'Codices :: ' . Yii::t('codices', 'Series Details');
$this->params = [
    'title' => Yii::t('codices', 'Book Series Details')
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['series/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['series/update', 'id' => $series->id]) ?>"><i class="fa fa-pencil"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['series/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr><th>#</th><td><?= $series->id ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Name') ?></th><td><?= $series->name ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Finished') ?></th><td><i class="fa <?= $series->finished ? 'fa-check' : 'fa-times' ?>"></i></td></tr>
        <tr><th><?= Yii::t('codices', 'Owned') ?></th><td><?= $series->ownCount ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Total') ?></th><td><?= $series->bookCount ?></td></tr>
    </table>
</div>
