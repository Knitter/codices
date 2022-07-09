<?php

use common\models\Book;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */
/* @var $filter codices\filters\Books */
/* @var $series array */

$this->title = 'Books';
$this->params = [
    'tab' => 'books',
    'actions' => [
            ['link' => ['/books/add'], 'title' => Yii::t('codices', 'New Book')]
    ]
];
?>

<div class="card">
    <div class="card-body">
        <?=
        GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $filter,
            'layout' => '<div class="table-responsive">{errors} {items}</div><div class="d-flex align-items-center">{summary} {pager}</div>',
            'tableOptions' => ['class' => 'table card-table table-vcenter text-nowrap datatable'],
            'pager' => [
                'options' => ['class' => 'pagination m-0 ms-auto'],
                'linkOptions' => ['class' => 'page-link'],
                'linkContainerOptions' => ['class' => 'page-item'],
                'disabledListItemSubTagOptions' => [
                    'tag' => 'a',
                    'href' => '#',
                    'class' => 'page-link'
                ]
            ],
            'columns' => [
                [
                    'attribute' => 'title',
                    'content' => function ($model) {
                        return Html::a($model->title, ['edit', 'id' => $model->id]);
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'subTitle',
                    'content' => function ($model) {
                        return $model->subTitle ?: '';
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'series',
                    'content' => function ($model) {
                        return $model->seriesId ? $model->series->name : '';
                    },
                    'filter' => $series,
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'format',
                    'content' => function ($model) {
                        return $model->format ?: '';
                    },
                    'filter' => Book::formatList(),
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'isbn',
                    'content' => function ($model) {
                        return $model->isbn ?: '';
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
            ]
        ])
        ?>
    </div>
</div>
