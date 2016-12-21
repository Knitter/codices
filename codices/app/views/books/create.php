<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Book */

$this->title = Yii::t('codices', 'New book');
$this->params = [
    'title' => Yii::t('codices', 'New book'),
    'tab' => 'books'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['books/index']) ?>"><i class="fa fa-list"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
