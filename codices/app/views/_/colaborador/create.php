<?php
/* @var $this yii\web\View */
/* @var $formulario app\models\forms\Colaborador */

$this->title = 'Novo Colaborador';

$this->params = [
    'tab' => 'colaboradores',
    'titulo' => 'Novo Colaborador',
    'accoes' => [
        ['Adicionar colaborador', ['colaborador/create']],
    ]
];
?>

<div class="row">
    <div class="col-xs-12">
        <?= $this->render('_form', [ 'formulario' => $formulario]) ?>
    </div>
</div>