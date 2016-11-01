<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Series */

$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form']]);
?>

<?=
$form->field($model, 'name', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8">{input}</div>'
])->textInput(['class' => 'form-control'])
?>

<?=
$form->field($model, 'bookCount', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-3">{input}</div>'
])->textInput(['class' => 'form-control'])
?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['series/index']) ?>"><?= Yii::t('codices', 'Cancel') ?></a>
    </div>
</div>

<?php
ActiveForm::end();
