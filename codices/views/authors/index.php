<?php

use common\models\Book;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */
/* @var $filter codices\filters\Authors */
/* @var $series array */

$this->title = 'Authors';
$this->params = [
    'tab' => 'authors'
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
                    'attribute' => 'name',
                    'content' => function ($model) {
                        return Html::a($model->name, ['edit', 'id' => $model->id]);
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'surname',
                    'content' => function ($model) {
                        return $model->surname ?: '';
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ]
            ]
        ])
        ?>
    </div>
</div>
