<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin(['layout' => 'horizontal']);
?>
<div class = "col-md-12">
    <div class = "card">
        <div class = "card-header">@TODO</div>
        <div class = "card-body">
            <form class = "form form-horizontal">
                <div class = "section">
                    <div class = "section-body">

                        <!-- //@TODO: Extract/Replace -->
                        <div class = "form-group">
                            <label class = "col-md-3 control-label">Name</label>
                            <div class = "col-md-9">
                                <input type = "text" class = "form-control" placeholder = "">
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class = "col-md-3">
                                <label class = "control-label">Description</label>
                                <p class = "control-label-help">( short detail of products, 150 max words )</p>
                            </div>
                            <div class = "col-md-9">
                                <textarea class = "form-control"></textarea>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-md-3 control-label">Price</label>
                            <div class = "col-md-9">
                                <div class = "input-group">
                                    <span class = "input-group-addon">$</span>
                                    <input type = "text" class = "form-control" aria-label = "Amount (to the nearest dollar)">
                                </div>
                            </div>
                        </div>

                        <!-- //END: @TODO -->
                    </div>
                </div>

                <div class = "form-footer">
                    <div class = "form-group">
                        <div class = "col-md-9 col-md-offset-3">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>

                            <?=
                            Html::a(Yii::t('codices', 'Cancelar')
                                    , Url::to(['aditamento/index', 'id' => $processo->id])
                                    , ['class' => 'btn btn-default'])
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
ActiveForm::end();
