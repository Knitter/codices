<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model codices\forms\Author */

$form = ActiveForm::begin([
    'options' => [
        'class' => 'prevent-enter-submit'
    ]
]);
?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-7">
                    <?= $form->field($model, 'name') ?>

                    <?= $form->field($model, 'surname') ?>
                </div>

                <div class="col-5">
                    <!-- //TODO: Photo -->
                </div>
            </div>

            <?= $form->field($model, 'website') ?>

            <?= $form->field($model, 'biography')->textarea(['rows' => 3]) ?>
        </div>

        <div class="card-footer text-end">
            <div class="d-flex">
                <a href="<?= Url::to(['index']) ?>" class="btn btn-link me-auto">Cancel</a>

                <?php if (!$model->isNewRecord()) { ?>
                    <a href="<?= Url::to(['delete', 'id' => $model->id]) ?>"
                       class="btn btn-danger"><?= Yii::t('codices', 'Delete') ?></a>
                <?php } ?>

                <button type="submit" class="btn btn-primary ms-2"><?= Yii::t('codices', 'Save') ?></button>
            </div>
        </div>
    </div>
<?php
ActiveForm::end();