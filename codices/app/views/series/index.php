<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $filter \app\models\filters\Series */

$this->title = 'Codices :: ' . Yii::t('codices', 'Book Series');
$this->params = [
    'title' => Yii::t('codices', 'List of Book Series'),
    'tab' => 'series'
];
?>

<div class="table-responsive">
    <?=
    GridView::widget([
        'dataProvider' => $filter->search(Yii::$app->request->get()),
        'layout' => '{items} {summary} {pager}',
        'columns' => [
            'id',
            'name'
        ]
    ])
    ?>
</div>