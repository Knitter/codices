<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
//use kartik\date\DatePicker;
//-
use common\models\Author;
use common\models\Book;
use common\models\Series;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Book */

$authors = [0 => Yii::t('codices', '- none -')] + ArrayHelper::map(Author::find()
                        ->orderBy(['(CONCAT(name, " ", surname))' => SORT_ASC])
                        ->all(), 'id', 'fullName');

$series = [0 => Yii::t('codices', '- none -')];
if (!$model->id || !$model->authorId) {
    $series += ArrayHelper::map(Series::find()->orderBy('name')->all(), 'id', 'name');
} else {
    $series += ArrayHelper::map(Series::find()->where(['authorId' => $model->authorId])->orderBy('name')
                            ->all(), 'id', 'name');
}
$formats = [0 => Yii::t('codices', ' - not set -')] + Book::formatList();

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

$this->registerJs("$('input[type=\"checkbox\"]').iCheck({ checkboxClass: 'icheckbox_square-aero' });");
$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form']]);
?>

<?= $form->field($model, 'title', $standardFieldOptions)->textInput(['class' => 'form-control']) ?>

<?=
$form->field($model, 'authorId', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8"><div class="input-group">{input}<span class="input-group-btn">'
    . '<a href="#newauthor" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i></a>'
    . '</span></div></div>'
])->dropDownList($authors, [
    'class' => 'form-control',
    'onchange' => 'codices.authorUpdated(\'' . Url::to(['series/ajax-list']) . '\')'
])
?>

<?=
$form->field($model, 'seriesId', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8"><div class="input-group">{input}<span class="input-group-btn">'
    . '<a href="#newseries" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i></a>'
    . '</span></div></div>'
])->dropDownList($series, ['class' => 'form-control'])
?>

<?= $form->field($model, 'order', $smallFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'isbn', $mediumFieldOptions)->textInput(['class' => 'form-control']) ?>

<?=
$form->field($model, 'url', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8"><div class="input-group">{input}'
    . ($model->url ? '<span class="input-group-btn"><a href="' . $model->url
            . '" class="btn btn-default"><i class="fa fa-external-link"></i></a></span>' :
            '<span class="input-group-addon"><i class="fa fa-external-link"></i></span>')
    . '</div></div>'
])->textInput(['class' => 'form-control'])
?>

<?= $form->field($model, 'rating', $smallFieldOptions)->textInput() ?>

<?= $form->field($model, 'plot', $standardFieldOptions)->textarea(['class' => 'form-control']) ?>

<?= $form->field($model, 'edition', $mediumFieldOptions)->textInput(['class' => 'form-control']) ?>

<?php
//TODO: Fix date widget
//=
//$form->field($model, 'publicationDate', $mediumFieldOptions)->widget(DatePicker::className(), [
//    'type' => DatePicker::TYPE_COMPONENT_APPEND,
//    'removeButton' => false,
//    //'language' => 'pt',
//    'pluginOptions' => [
//        'autoclose' => true,
//        'format' => 'yyyy-mm-dd'
//    ]
//]);
?>

<?= $form->field($model, 'publisher', $standardFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'language', $mediumFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'format', $mediumFieldOptions)->dropDownList($formats) ?>

<?= $form->field($model, 'pageCount', $smallFieldOptions)->textInput(['class' => 'form-control']) ?>

<?=
$form->field($model, 'read', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-3">{input}</div>'
])->checkbox(null, false)
?>

<?=
$form->field($model, 'copies', $smallFieldOptions)->dropDownList(
        [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], ['class' => 'form-control']
)
?>

<?= $form->field($model, 'review', $standardFieldOptions)->textarea(['class' => 'form-control']) ?>

<?= $form->field($model, 'cover', $standardFieldOptions)->fileInput() ?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type ="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['books/index']) ?>">
            <?= Yii::t('codices', 'Cancel') ?>
        </a>
    </div>
</div>

<?php
ActiveForm::end();

echo $this->render('_modal-newauthor'),
 $this->render('_modal-newseries');
