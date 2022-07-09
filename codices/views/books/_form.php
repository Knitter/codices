<?php

use common\models\Book;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model codices\forms\Book */
/* @var $series array */
/* @var $publishers array */
/* @var $genres array */

$form = ActiveForm::begin([
    'options' => [
        'class' => 'prevent-enter-submit'
    ],
//    'layout' => ActiveForm::LAYOUT_HORIZONTAL,
    'enableClientValidation' => false,
//    'fieldConfig' => [
//        'horizontalCssClasses' => [
//            'label' => 'col-sm-3 col-form-label',
//            'wrapper' => 'col-sm-9 col-lg-6'
//        ],
//        'inputOptions' => [
//            'class' => 'form-control'
//        ],
//        'options' => [
//            'class' => 'form-group form-row mb-2'
//        ]
//    ]
]);
?>
    <div class="card">
        <div class="card-body">
            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'translated')->checkbox() ?>
            <?= $form->field($model, 'favorite')->checkbox() ?>
            <?= $form->field($model, 'copies')->textInput(['type' => 'number']) ?>
            <?= $form->field($model, 'subTitle') ?>
            <?= $form->field($model, 'origionalTitle') ?>
            <?= $form->field($model, 'isbn') ?>
            <?= $form->field($model, 'plot')->textarea() ?>
            <?= $form->field($model, 'format')->dropDownList(['' => ''] + Book::formatList()) ?>
            <?= $form->field($model, 'publisherId')->dropDownList($publishers) ?>
            <?= $form->field($model, 'orderInSeries') ?>
            <?= $form->field($model, 'duplicatesBookdId') ?>
            <?= $form->field($model, 'ownRating') ?>
            <?= $form->field($model, 'seriesId')->dropDownList($series) ?>
            <?= $form->field($model, 'pageCount') ?>
            <?= $form->field($model, 'publishDate') ?>
            <?= $form->field($model, 'publishYear') ?>
            <?= $form->field($model, 'language') ?>
            <?= $form->field($model, 'translatedIn') ?>
            <?= $form->field($model, 'edition') ?>
            <?= $form->field($model, 'rating') ?>
            <?= $form->field($model, 'review')->textarea() ?>
            <?= $form->field($model, 'cover') ?>
            <?= $form->field($model, 'filename') ?>
        </div>

        <div class="card-footer text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-link">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto"><?= Yii::t('codices', 'Save') ?></button>
            </div>
        </div>
    </div>
<?php
ActiveForm::end();