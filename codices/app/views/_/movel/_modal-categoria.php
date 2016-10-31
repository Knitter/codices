<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->registerJs('$("#modal-categoria").on("hidden.bs.modal", pgespro.closeModalCategoria );');

Modal::begin([
    'id' => 'modal-categoria',
    'header' => '<h4 class="model-title">Nova Categoria</h4>',
    'footer' => '<button type="button" class="btn btn-success" onclick="pgespro.ajaxCreateCategoria()">Criar</button><button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>'
]);
?>

<?= Html::beginForm(Url::to(['categoria/ajax-create']), 'POST', ['role' => 'form']) ?>
<div class="container-fluid">
    <div class="row">
        <label class="col-xs-4 control-label">Nome</label>
        <div class="col-xs-8">
            <?= Html::textInput('Categoria[nome]', null, ['class' => 'form-control', 'id' => 'categoria-nome', 'maxlength' => 255]); ?>
        </div>
    </div>
</div>
<?= Html::endForm() ?>

<?php
Modal::end();
