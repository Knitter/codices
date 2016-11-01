<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
//-
use common\models\Book;
use common\models\Series;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Book */

$series = ArrayHelper::map(Series::find()->orderBy('name')->all(), 'id', 'name');

$standardFieldOptions = [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8">{input}</div>'
];

$mediumFieldOptions = [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-4">{input}</div>'
];

$smallFieldOptions = [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-3">{input}</div>'
];

$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form']]);
?>

<?= $form->field($model, 'title', $standardFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'plot', $standardFieldOptions)->textarea(['class' => 'form-control']) ?>

<?= $form->field($model, 'isbn', $mediumFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'format', $mediumFieldOptions)->dropDownList(Book::formatList()) ?>

<?= $form->field($model, 'pageCount', $smallFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'publicationDate', $mediumFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'language', $mediumFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'edition', $mediumFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'publisher', $standardFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'rating', $smallFieldOptions)->textInput() ?>

<?= $form->field($model, 'url', $standardFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'review', $standardFieldOptions)->textarea(['class' => 'form-control']) ?>

<?= $form->field($model, 'cover', $standardFieldOptions)->fileInput() ?>

<?= $form->field($model, 'order', $smallFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'seriesId', $standardFieldOptions)->dropDownList($series, ['class' => 'form-control']) ?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type ="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['books/index']) ?>"><?= Yii::t('codices', 'Cancel') ?></a>
    </div>
</div>

<?php
ActiveForm::end();
