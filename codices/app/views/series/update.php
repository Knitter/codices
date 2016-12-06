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
    <a class="btn" href="<?= Url::to(['series/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
