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
    <a class="btn" href="<?= Url::to(['authors/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<?=
$this->render('_form', ['model' => $model]);
