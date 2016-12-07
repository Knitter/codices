<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Series */

$this->title = 'Codices :: ' . Yii::t('codices', 'New Series');
$this->params = [
    'title' => Yii::t('codices', 'New Book Series'),
    'tab' => 'series'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['series/index']) ?>"><i class="fa fa-list"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
