<?php
/* @var $this yii\web\View */
/* @var $aditamento common\models\Aditamento */

$this->title = $processo->referencia . ': Novo Aditamento';

$this->params = [
    'tab' => 'aditamentos',
    'processo' => $processo,
    'titulo' => 'Novo Aditamento',
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