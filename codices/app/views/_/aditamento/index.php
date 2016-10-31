<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
//-
use common\models\Aditamento;

/* @var $this yii\web\View */
/* @var $processo \common\models\Processo */
/* @var $filter \app\models\filters\Aditamentos */

$pageSize = (int) Yii::$app->user->identity->colaborador->registos ? : 50;

$processo = $filter->processo;
$this->title = $processo->referencia . ': Aditamentos';

$this->params = [
    'tab' => 'aditamentos',
    'processo' => $processo,
    'titulo' => 'Aditamentos',
    'subtitulo' => $processo->identificacao,
    'accoes' => [
        ['Novo aditamento', ['aditamento/create', 'id' => $processo->id]],
    ]
];

$updateCallback = function ($url, $model, $key) {
    return Html::a('<i class="fa fa-pencil"></i>', Url::to(['aditamento/update', 'id' => $model->id]), ['class' => 'btn btn-default']);
};

$deleteCallback = function ($url, $model, $key) {
    return Html::a('<i class="fa fa-trash"></i>', Url::to(['aditamento/delete', 'id' => $model->id]), ['class' => 'btn btn-danger', 'data-confirm' => 'Tem a certeza que deseja remover o aditamento?']);
};

$tipoCallback = function($model, $key, $index, $column) {
    return $model->labelTipoVerbaAditada();
};

$tipoDocCallback = function($model, $key, $index, $column) {
    return $model->labelTipoDocumento();
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
                    'attribute' => 'numAditamento',
                    'headerOptions' => ['style' => 'width: 120px;']
                ],
                [
                    'attribute' => 'dataAditamento',
                    'headerOptions' => ['style' => 'width: 120px;']
                ],
                [
                    'attribute' => 'tipoVerba',
                    'content' => $tipoCallback,
                    'headerOptions' => ['style' => 'width: 120px;'],
                    'filter' => Aditamento::listaTiposVerbasAditadas()
                ],
                [
                    'attribute' => 'tipoDocumento',
                    'content' => $tipoDocCallback,
                    'headerOptions' => ['style' => 'width: 160px;'],
                    'filter' => Aditamento::listaTiposDocumento()
                ],
                'louvado',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '<div class="btn-group">{update} {delete}</div>',
                    'headerOptions' => ['style' => 'text-align: center; width: 130px;'],
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
