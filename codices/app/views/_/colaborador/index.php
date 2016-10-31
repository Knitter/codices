<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
//-
use common\models\Conta;
use common\models\Franchisado;

/* @var $this yii\web\View */
/* @var $filter app\models\filters\Colaboradores */

$pageSize = (int) Yii::$app->user->identity->colaborador->registos ? : 50;
$this->title = 'Colaboradores';

$this->params = [
    'tab' => 'colaboradores',
    'titulo' => 'Colaboradores',
    'subtitulo' => 'Utilizadores com acesso à plataforma',
    'accoes' => [
        ['Adicionar colaborador', ['colaborador/create']],
    ]
];

$viewCallback = function ($url, $model, $key) {
    return Html::a('<i class="fa fa-info"> </i>', Url::to(['colaborador/view', 'id' => $model->id]), ['class' => 'btn btn-info']);
};

$updateCallback = function ($url, $model, $key) {
    return Html::a('<i class="fa fa-pencil"> </i>', Url::to(['colaborador/update', 'id' => $model->id]), ['class' => 'btn btn-default']);
};

$deleteCallback = function ($url, $model, $key) {
    return Html::a('<i class="fa fa-trash"></i>', Url::to(['colaborador/delete', 'id' => $model->id]), ['class' => 'btn btn-danger', 'data-confirm' => 'Tem a certeza que deseja remover o utilizador?']);
};

$nomeCallback = function($model, $key, $index, $column) {
    $nome = $model->nome;
    if ($model->conta && $model->conta->estado == Conta::ESTADO_BLOQUEADO) {
        return '<strong class="text-danger">' . $nome . '</strong>';
    }

    return Html::a($nome, Url::to(['colaborador/update', 'id' => $model->id]));
};

$emailCallback = function($model, $key, $index, $column) {
    return $model->conta->email;
};

$adminCallback = function($model, $key, $index, $column) {
    return $model->administrador ? '<i class="fa fa-check"></i>' : '';
};

$gruposCallback = function($model, $key, $index, $column) {
    return $model->labelListaGrupos();
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
                    'label' => 'Nome',
                    'attribute' => 'nome',
                    'content' => $nomeCallback,
                ],
                [
                    'label' => 'E-mail',
                    'attribute' => 'email',
                    'content' => $emailCallback
                ],
                [
                    'label' => 'Telemóvel',
                    'attribute' => 'telemovel',
                ],
                [
                    'label' => 'Franchisado',
                    'attribute' => 'grupo',
                    'headerOptions' => ['style' => 'width: 160px;'],
                    'content' => $gruposCallback,
                    'filter' => [0 => '- Avalibérica -'] + ArrayHelper::map(Franchisado::find()
                                    ->orderBy('nome')->all(), 'id', 'nome'),
                    'visible' => Yii::$app->user->identity->colaborador->isColaboradorSede()
                ],
                [
                    'label' => 'Administrador',
                    'attribute' => 'administrador',
                    'headerOptions' => ['style' => 'text-align: center; width: 120px;'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                    'content' => $adminCallback,
                    'filter' => [0 => 'Não', 1 => 'Sim']
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '<div class="btn-group">{view} {update} {delete}</div>',
                    'headerOptions' => ['style' => 'text-align: center; width: 130px;'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                    'buttons' => [
                        'view' => $viewCallback,
                        'update' => $updateCallback,
                        'delete' => $deleteCallback
                    ]
                ]
            ]
        ])
        ?>
    </div>
</div>
