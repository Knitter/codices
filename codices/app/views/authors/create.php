<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Author */

$this->title = Yii::t('codices', 'New author');
$this->params = [
    'title' => Yii::t('codices', 'New author'),
    'tab' => 'authors'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['authors/index']) ?>"><i class="fa fa-list"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
