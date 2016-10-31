<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $filter app\models\filters\Categorias */

$pageSize = (int) Yii::$app->user->identity->colaborador->registos ? : 50;
$this->title = 'Categorias';

$this->params = [
    'tab' => 'categorias',
    'titulo' => 'Categorias',
    'subtitulo' => 'Categorias de bens móveis',
    'accoes' => [
        ['Nova Categoria', ['categoria/create']],
    ],
];

$updateCallback = function ($url, $model, $key) {
    return Html::a('<i class="fa fa-pencil"></i>', Url::to(['categoria/update', 'id' => $model->id]), ['class' => 'btn btn-default']);
};

$deleteCallback = function ($url, $model, $key) {
    return Html::a('<i class="fa fa-trash"></i>', Url::to(['categoria/delete', 'id' => $model->id]), ['class' => 'btn btn-danger', 'data-confirm' => 'Tem a certeza que deseja remover a categoria?']);
};

$nomeCallback = function($model, $key, $index, $column) {
    return Html::a($model->nome, Url::to(['categoria/update', 'id' => $model->id]));
};
?>

<div class="row">
    <div class="col-xs-12">
        <?=
        GridView::widget([
            'dataProvider' => $filter->search(Yii::$app->request->get(), $pageSize),
            'filterModel' => $filter,
            'layout' => '{items} {summary} {pager}',
            'columns' => [
                [
                    'attribute' => 'nome',
                    'content' => $nomeCallback
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '<div class="btn-group">{update} {delete}</div>',
                    'headerOptions' => ['style' => 'text-align: center; width: 95px;'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                    'buttons' => [
                        'update' => $updateCallback,
                        'delete' => $deleteCallback
                    ]
                ]
            ]
        ])
        ?>
    </div>
</div>
