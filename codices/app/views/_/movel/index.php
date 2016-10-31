<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
//-
use common\models\Aditamento;
use common\models\Foto;
use common\models\Verba;
use app\models\filters\Moveis;

/* @var $this yii\web\View */
/* @var $processo \common\models\Processo */
/* @var $filter \app\models\filters\Moveis */

$pageSize = (int) Yii::$app->user->identity->colaborador->registos ? : 50;
$processo = $filter->processo;

$this->title = $processo->referencia . ': Bens Móveis & Viaturas';

$accoes = [
    ['Adicionar bem móvel', ['movel/create', 'id' => $processo->id]],
    ['Adicionar viatura', ['viatura/create', 'id' => $processo->id]],
    ['--'],
    ['Mapa de viaturas', ['viatura/mapa-viaturas', 'id' => $processo->id, 'from' => 'vidx']],
    ['--'],
    ['Gerar documentos', '#', 'fa-briefcase', ['data-toggle' => 'modal', 'data-target' => '#modal-docs-moveis']],
];

if ($processo->hasFotosMoveis()) {
    $accoes[] = ['--'];
    $accoes[] = ['Arquivo de Fotos', ['documentacao/arquivo-fotos-moveis', 'id' => $processo->id], 'fa-download', ['target' => '_blank']];
}


$this->params = [
    'tab' => 'moveis',
    'processo' => $processo,
    'titulo' => 'Bens Móveis & Viaturas',
    'subtitulo' => $processo->identificacao,
    'accoes' => $accoes
];

$viewCallback = function ($url, $model, $key) {
    $link = Url::to(['viatura/view', 'id' => $model['id']]);
    if ($model['tipo'] == Verba::TIPO_VERBA_MOVEL) {
        $link = Url::to(['movel/view', 'id' => $model['id']]);
    }

    return Html::a('<i class="fa fa-info"></i>', $link, ['class' => 'btn btn-info']);
};

$updateCallback = function ($url, $model, $key) {
    $link = Url::to(['viatura/update', 'id' => $model['id']]);
    if ($model['tipo'] == Verba::TIPO_VERBA_MOVEL) {
        $link = Url::to(['movel/update', 'id' => $model['id']]);
    }

    return Html::a('<i class="fa fa-pencil"></i>', $link, ['class' => 'btn btn-default']);
};

$deleteCallback = function ($url, $model, $key) {
    $link = Url::to(['viatura/delete', 'id' => $model['id']]);
    if ($model['tipo'] == Verba::TIPO_VERBA_MOVEL) {
        $link = Url::to(['movel/delete', 'id' => $model['id']]);
    }

    return Html::a('<i class="fa fa-trash"></i>', $link, ['class' => 'btn btn-danger', 'data-confirm' => 'Tem a certeza que deseja remover a verba?']);
};

$tipoCallback = function($model, $key, $index, $column) {
    return $model['tipo'] == Verba::TIPO_VERBA_MOVEL ? 'Bens Móveis' : 'Viaturas';
};

$aditamentoCallback = function($model, $key, $index, $column) {
    return $model['idAditamento'] ? $model['numAditamento'] : '';
};

$descricaoCallback = function($model, $key, $index, $column) {
    return $model['descricao'] . '<br />' . $model['notaSite'];
};

$valorCallback = function($model, $key, $index, $column) {
    return number_format($model['valorBase'], 2, ',', '.') . ' &euro;';
};

$fotoCallback = function($model, $key, $index, $column) {
    $fotos = Foto::find()->where(['idVerba' => $model['id']])->orderBy(['ordem' => SORT_ASC])->all();
    if (($count = count($fotos))) {
        $foto = array_shift($fotos);
        $html = '<div class="foto"><img style="width: 60px;height:60px;" src="' . Url::to(['foto/versao-privada', 'id' => $foto->id]) . '" /><span class="label label-success">' . $count . '</span></div>';
        return $html;
    }

    return 'S/Fotos';
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
                    'label' => 'Tipo',
                    'attribute' => 'tipo',
                    'content' => $tipoCallback,
                    'headerOptions' => ['style' => 'width: 120px;'],
                    'filter' => Moveis::listaTipos()
                ],
                [
                    'label' => 'N/Aditamento',
                    'attribute' => 'idAditamento',
                    'content' => $aditamentoCallback,
                    'headerOptions' => ['style' => 'width: 120px;'],
                    'filter' => ArrayHelper::map(Aditamento::listaAditamentosProcesso($processo->id), 'id', 'numAditamento')
                ],
                [
                    'label' => 'N/Verba',
                    'headerOptions' => ['style' => 'width: 60px;'],
                    'attribute' => 'numeroVerba',
                ],
                [
                    'label' => 'Descrição',
                    'attribute' => 'descricao',
                    'content' => $descricaoCallback,
                    'contentOptions' => ['class' => 'text-justify'],
                ],
                [
                    'header' => 'Fotografias',
                    'content' => $fotoCallback,
                    'headerOptions' => ['style' => 'text-align: center; width: 80px;'],
                    'contentOptions' => ['class' => 'text-center'],
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

<?php
if ($processo->isProcessoInsolvencia()) {
    if ($processo->processoJudicial->proprietario->codigoDocumentos == 'apd') {
        echo $this->render('_modal-docs-insolvencia-angelo-dias', ['processo' => $processo]);
    } else {
        echo $this->render('_modal-docs-insolvencia', ['processo' => $processo]);
    }
} else {
    echo $this->render('_modal-docs', ['processo' => $processo]);
}
