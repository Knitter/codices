<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $filter \app\models\filters\Collections */

$this->title = 'Codices :: ' . Yii::t('codices', 'Book Collections');
$this->params = [
    'title' => Yii::t('codices', 'List of Book Collections'),
    'tab' => 'collections'
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