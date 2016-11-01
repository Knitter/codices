<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $filter \app\models\filters\Collections */

$this->title = 'Codices :: ' . Yii::t('codices', 'Book Collections');
$this->params = [
    'title' => Yii::t('codices', 'List of Book Collections'),
    'tab' => 'collections'
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['collections/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    GridView::widget([
        'dataProvider' => $filter->search(Yii::$app->request->get()),
        'layout' => '{items} {summary} {pager}',
        'columns' => [
                [
                'attribute' => 'id',
                'label' => '#',
                'headerOptions' => ['class' => 'id-column']
            ], [
                'attribute' => 'name',
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->name, Url::to(['collections/view', 'id' => $model->id]));
                }
            ], [
                'attribute' => 'ownCount',
                'label' => 'Owned',
                'headerOptions' => ['style' => 'width: 120px;'],
                'content' => function($model, $key, $index, $column) {
                    return $model->ownCount ?: 0;
                }
            ], [
                'attribute' => 'bookCount',
                'label' => 'Total',
                'headerOptions' => ['style' => 'width: 120px;'],
                'content' => function($model, $key, $index, $column) {
                    return $model->ownCount ?: 0;
                }
            ], [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['class' => 'action-buttons'],
                'contentOptions' => ['class' => 'action-buttons'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::to(['collections/update', 'id' => $model->id]), ['class' => 'text-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', Url::to(['collections/delete', 'id' => $model->id]), ['class' => 'text-danger', 'data-confirm' => Yii::t('codices', 'Are you sure you want to remove the selected book collection?')]);
                    }
                ]
            ]
        ]
    ])
    ?>
</div>
