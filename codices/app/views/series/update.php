<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Series */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Series');
$this->params = [
    'title' => Yii::t('codices', 'Edit Book Series'),
    'tab' => 'series'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['series/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['series/view', 'id' => $model->id]) ?>"><i class="fa fa-eye"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['series/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
