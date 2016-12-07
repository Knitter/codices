<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $filter \app\models\filters\Series */

$this->title = 'Codices :: ' . Yii::t('codices', 'Book Series');
$this->params = [
    'title' => Yii::t('codices', 'List of Book Series'),
    'tab' => 'series'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-success" href="<?= Url::to(['series/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    GridView::widget([
        'dataProvider' => $filter->search(Yii::$app->request->get()),
        'filterModel' => $filter,
        'layout' => '{items} {summary} {pager}',
        'columns' => [
                [
                'attribute' => 'name',
                'label' => Yii::t('codices', 'Name'),
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->name, Url::to(['series/view', 'id' => $model->id]));
                }
            ], [
                'attribute' => 'authorId',
                'label' => Yii::t('codices', 'Author'),
                'content' => function($model, $key, $index, $column) {
                    return $model->authorId ? Html::a($model->author->fullName, Url::to(['author/view', 'id' => $model->authorId])) : '';
                }
            ], [
                'attribute' => 'ownCount',
                'label' => Yii::t('codices', 'Owned'),
                'headerOptions' => ['style' => 'width: 120px;'],
                'content' => function($model, $key, $index, $column) {
                    return $model->ownCount ?: 0;
                }
            ], [
                'attribute' => 'bookCount',
                'label' => Yii::t('codices', 'Total'),
                'headerOptions' => ['style' => 'width: 120px;'],
                'content' => function($model, $key, $index, $column) {
                    return $model->bookCount ?: 0;
                }
            ], [
                'attribute' => 'finished',
                'label' => Yii::t('codices', 'Completed'),
                'headerOptions' => ['style' => 'width: 120px;'],
                'content' => function($model, $key, $index, $column) {
                    return $model->finished ? '<i class="fa fa-check"></i>' : '';
                },
                'filter' => [0 => Yii::t('codices', 'No'), 1 => Yii::t('codices', 'Yes')]
            ], [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['class' => 'action-buttons'],
                'contentOptions' => ['class' => 'action-buttons'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::to(['series/update', 'id' => $model->id]), ['class' => 'btn btn-xs btn-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', Url::to(['series/delete', 'id' => $model->id]), ['class' => 'btn btn-xs btn-danger', 'data-confirm' => Yii::t('codices', 'Are you sure you want to remove the selected book series?')]);
                    }
                ]
            ]
        ]
    ])
    ?>
</div>
