<?php
/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Author */

$this->title = 'Codices :: ' . Yii::t('codices', 'New Author');
$this->params = [
    'title' => Yii::t('codices', 'New Book Author'),
    'tab' => 'authors'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['authors/index']) ?>"><i class="fa fa-list"></i></a>
</div>

<?=
$this->render('_form', ['model' => $model]);
