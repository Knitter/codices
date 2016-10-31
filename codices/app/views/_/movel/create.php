<?php
/* @var $this yii\web\View */
/* @var $formulario app\models\forms\Movel */
/* @var $processo \common\models\Processo */

$processo = $formulario->processo;

$this->title = $processo->referencia . ': Novo Bem Móvel';

$this->params = [
    'tab' => 'moveis',
    'processo' => $processo,
    'titulo' => 'Novo Bem Móvel',
    'subtitulo' => $processo->identificacao,
    'accoes' => [
        ['Adicionar bem móvel', ['movel/create', 'id' => $processo->id]],
        ['Adicionar viatura', ['viatura/create', 'id' => $processo->id]],
        ['--'],
        ['Gerar documentos', '#', 'fa-briefcase', ['data-toggle' => 'modal', 'data-target' => '#modal-docs-moveis']],
    ]
];
?>

<div class="row">
    <div class="col-xs-12">
        <?= $this->render('_form', [ 'formulario' => $formulario]) ?>
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