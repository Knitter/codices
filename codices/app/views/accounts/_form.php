<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Account */

$togglePwdVisibility = '$("#pwdvisibility").click(function () { var $elem = $(this), $sibling; $sibling = $elem.siblings("input[type=password]"); if ($sibling.length === 1) { $sibling.attr("type", "text"); $elem.find("i").removeClass("fa-eye-slash").addClass("fa-eye"); } else { $sibling = $elem.siblings("input[type=text]"); if ($sibling.length === 1) { $sibling.attr("type", "password"); $elem.find("i").removeClass("fa-eye").addClass("fa-eye-slash"); } } return false; });';
$this->registerJs($togglePwdVisibility);

$inputFieldOptions = [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8">{input}</div>'
];

$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form']]);
?>

<?= $form->field($model, 'name', $inputFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'email', $inputFieldOptions)->textInput(['class' => 'form-control']) ?>

<?=
$form->field($model, 'password', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8"><div class="input-group">{input}<a href="#" id="pwdvisibility" class="input-group-addon"><i class="fa fa-eye-slash"></i></a></div></div>'
])->passwordInput(['class' => 'form-control', 'placeholder' => !$model->isNewRecord ? Yii::t('codices', 'Leave empty to keep the same password ...') : ''])
?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['accounts/index']) ?>"><?= Yii::t('codices', 'Cancel') ?></a>
    </div>
</div>

<?php
ActiveForm::end();
