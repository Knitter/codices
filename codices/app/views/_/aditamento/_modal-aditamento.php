<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;
//-
use common\models\Aditamento;

/* @var $this yii\web\View */
/* @var $field string */
/* @var $processo \common\models\Processo */

$this->registerJs('$("#modal-modelo").on("hidden.bs.modal", pgespro.closeModalAditamento );');

Modal::begin([
    'id' => 'modal-aditamento',
    'header' => '<h4 class="model-title">Novo Aditamento</h4>',
    'footer' => '<button type="button" class="btn btn-success" onclick="pgespro.ajaxCreateAditamento(\''
    . $field . '\')">Criar</button><button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>'
]);
?>

<?= Html::beginForm(Url::to(['aditamento/ajax-create']), 'POST', ['role' => 'form']) ?>

<div class="container-fluid">
    <div class="row">
        <label class="col-xs-4 control-label">N/Aditamento</label>
        <div class="col-xs-5">
            <?= Html::textInput('Aditamento[numAditamento]', null, ['maxlength' => 5, 'class' => 'form-control', 'id' => 'aditamento-numero']) ?>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        <label class="col-xs-4 control-label">Data</label>
        <div class="col-xs-5">
            <?=
            DatePicker::widget([
                'name' => 'Aditamento[dataAditamento]',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'removeButton' => false,
                'language' => 'pt',
                'options' => ['placeholder' => '(automático)'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
            ?>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        <label class="col-xs-4 control-label">Tipo</label>
        <div class="col-xs-5">
            <?= Html::dropDownList('tipoVerba', $tipoVerba, Aditamento::listaTiposVerbasAditadas(), ['disabled' => 'disabled', 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <label class="col-xs-4 control-label">Aplicado</label>
        <div class="col-xs-5">
            <?= Html::dropDownList('Aditamento[tipoDocumento]', null, Aditamento::listaTiposDocumento(), ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="row" style="margin-top: 15px;">
        <label class="col-xs-4 control-label">Louvado</label>
        <div class="col-xs-8">
            <?= Html::textInput('Aditamento[louvado]', null, ['maxlength' => 255, 'class' => 'form-control', 'id' => 'aditamento-louvado']) ?>
        </div>
    </div>
</div>

<?= Html::hiddenInput('Aditamento[tipoVerba]', $tipoVerba) ?>
<?= Html::hiddenInput('Aditamento[idProcesso]', $processo->id) ?>

<?= Html::endForm() ?>

<?php
Modal::end();
