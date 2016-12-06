<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Book */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Book');
$this->params = [
    'title' => Yii::t('codices', 'Edit Book'),
    'tab' => 'books'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['books/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['books/view', 'id' => $model->id]) ?>"><i class="fa fa-eye"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['books/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
