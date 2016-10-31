<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $filter \app\models\filters\Accounts */

$this->title = 'Codices :: ' . Yii::t('codices', 'User Accounts');
$this->params = [
    'title' => Yii::t('codices', 'User Accounts'),
    'tab' => 'accounts'
];
?>


<div class="table-responsive">
    <?=
    GridView::widget([
        'dataProvider' => $filter->search(Yii::$app->request->get()),
        'layout' => '{items} {summary} {pager}',
        'columns' => [
            'id',
            'name',
            'email'
        ]
    ])
    ?>
</div>
