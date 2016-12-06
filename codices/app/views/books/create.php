<?php
/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Book */

$this->title = 'Codices :: ' . Yii::t('codices', 'New Book');
$this->params = [
    'title' => Yii::t('codices', 'New Book'),
    'tab' => 'books'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['books/index']) ?>"><i class="fa fa-list"></i></a>
</div>

<?=
$this->render('_form', ['model' => $model]);
