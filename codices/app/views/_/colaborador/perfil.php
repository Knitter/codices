<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $perfil \app\models\forms\Perfil */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Perfil';

$this->params = [
    'tab' => 'dashboard',
    'titulo' => 'Perfil',
    'subtitulo' => 'Dados de Conta'
];

$form = ActiveForm::begin([
            'layout' => 'horizontal',
            'enableClientValidation' => false,
            'options' => ['enctype' => 'multipart/form-data']
        ]);
?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#geral" data-toggle="tab">Dados Gerais</a></li>
                <li><a href="#acesso" data-toggle="tab">Dados de Acesso</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="geral">
                    <?= $form->field($perfil, 'nome')->textInput(['maxlength' => 100]) ?>

                    <?=
                    $form->field($perfil, 'telemovel', [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-xs-3'
                        ]
                    ])->textInput(['maxlength' => 15])
                    ?>

                    <?=
                    $form->field($perfil, 'iniciais', [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-xs-2'
                        ]
                    ])->textInput(['maxlength' => 5])
                    ?>

                    <?=
                    $form->field($perfil, 'registos', [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-xs-2'
                        ]
                    ])->dropDownList([25 => 25, 50 => 50, 100 => 100, 150 => 150, 200 => 200])
                    ?>

                    <div class="form-group">
                        <label class="control-label col-xs-3"><?= $perfil->attributeLabels()['foto']; ?></label>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <?=
                                FileInput::widget([
                                    'model' => $perfil,
                                    'attribute' => 'foto',
                                    'pluginOptions' => [
                                        'browseClass' => 'btn btn-info',
                                        'showPreview' => false,
                                        'showUpload' => false,
                                        'browseLabel' => ''
                                    ]
                                ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="acesso">            
                    <?= $form->field($perfil, 'email')->textInput(['maxlength' => 255, 'disabled' => 'disabled']) ?>

                    <?=
                    $form->field($perfil, 'password', [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-xs-4'
                        ]
                    ])->passwordInput(['placeholder' => 'Vazio para não alterar'])
                    ?>
                </div>
            </div>
        </div>

        <section class="box box-default">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>

                        <?= Html::a('Cancelar', Url::to(['dashboard/index']), ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
        </section>
        <?php ActiveForm::end(); ?>
    </div>
</div>

