<?php
/* @var $this yii\web\View */
/* @var $aditamento \common\models\Aditamento */
/* @var $processo \common\models\Processo */

$this->title = $processo->referencia . ': Editar Aditamento';

$this->params = [
    'tab' => 'aditamentos',
    'processo' => $processo,
    'titulo' => 'Editar Aditamento ',
    'subtitulo' => $processo->identificacao,
    'accoes' => [
        ['Novo aditamento', ['aditamento/create', 'id' => $processo->id]]
    ]
];
?>

<div class="row">
    <div class="col-xs-12">
        <?= $this->render('_form', [ 'aditamento' => $aditamento, 'processo' => $processo]) ?>
    </div>
</div>
