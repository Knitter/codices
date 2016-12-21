<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $filter \app\models\filters\Books */

$this->title = 'Codices :: ' . Yii::t('codices', 'Books');
$this->params = [
    'title' => Yii::t('codices', 'Book List'),
    'tab' => 'books'
];
?>

<div class="btn-group pull-right">
    <a class="btn btn-success" href="<?= Url::to(['books/create']) ?>"><i class="fa fa-plus"></i></a>
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
                'attribute' => 'title',
                'label' => Yii::t('codices', 'Title'),
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->title, Url::to(['books/view', 'id' => $model->id]));
                }
            ], [
                'attribute' => 'authorName',
                'label' => Yii::t('codices', 'Author'),
                'content' => function($model, $key, $index, $column) {
                    return $model->authorId ? Html::a($model->author->fullName, Url::to(['authors/view', 'id' => $model->authorId])) : '';
                }
            ], [
                'attribute' => 'isbn',
                'label' => Yii::t('codices', 'ISBN')
            ], [
                'attribute' => 'seriesName',
                'label' => Yii::t('codices', 'Series'),
                'content' => function($model, $key, $index, $column) {
                    return $model->seriesId ? Html::a($model->series->name, Url::to(['series/view', 'id' => $model->seriesId])) : '';
                }
            ], [
                'attribute' => 'genre',
                'label' => Yii::t('codices', 'Genre'),
                'content' => function($model, $key, $index, $column) {
                    return $model->genre ?: '';
                }
            ], [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['class' => 'action-buttons'],
                'contentOptions' => ['class' => 'action-buttons'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::to(['books/update', 'id' => $model->id]), ['class' => 'btn btn-xs btn-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', Url::to(['books/delete', 'id' => $model->id]), ['class' => 'btn btn-xs btn-danger', 'data-confirm' => Yii::t('codices', 'Are you sure you want to remove the selected book?')]);
                    }
                ]
            ]
        ]
    ])
    ?>
</div>
