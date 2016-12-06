<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Author */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Author');
$this->params = [
    'title' => Yii::t('codices', 'Edit Author'),
    'tab' => 'authors'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['authors/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['authors/view', 'id' => $model->id]) ?>"><i class="fa fa-eye"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['authors/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
