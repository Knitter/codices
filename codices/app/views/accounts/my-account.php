<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Account */

$this->title = 'Codices :: ' . Yii::t('codices', 'My Account');
$this->params = [
    'title' => Yii::t('codices', 'My Account')
];

$inputFieldOptions = [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-10">{input}</div>'
];

$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form']]);
?>

<?= $form->field($model, 'name', $inputFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'email', $inputFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'password', $inputFieldOptions)->passwordInput(['class' => 'form-control']) ?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['codices/dashboard']) ?>"><?= Yii::t('codices', 'Cancel') ?></a>
    </div>
</div>

<?php
ActiveForm::end();

