<?php

use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $processo common\models\Processo */

$urlInventario = Url::to(['movel/lista-bens', 'id' => $processo->id]);
$urlRRA = Url::to(['viatura/requerimento-registo-automovel', 'id' => $processo->id]);

Modal::begin([
    'id' => 'modal-docs-moveis',
    'header' => '<h4 class="model-title">Documentos de Bens Móveis</h4>',
    'footer' => '<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>'
]);
?>

<div class="container-fluid">
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-11 col-xsoffset-1">
            <a class="btn btn-app docs" href="<?= $urlInventario ?>" data-url="<?= $urlInventario ?>">
                <i class="fa fa-file-pdf-o"></i>
                Lista de Bens
            </a>

            <a class="btn btn-app docs" href="<?= $urlRRA ?>" data-url="<?= $urlRRA ?>" target="_blank">
                <i class="fa fa-file-pdf-o"></i>
                RRA
            </a>
        </div>
    </div>
</div>

<?php
Modal::end();
