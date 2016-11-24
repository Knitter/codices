<?php

use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Profile */
/* @var $filter \app\models\filters\Sessions */

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

<?=
$form->field($model, 'password', $inputFieldOptions)->passwordInput([
    'class' => 'form-control',
    'placeholder' => Yii::t('codices', 'Leave empty to keep the same password ...')
])
?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['codices/dashboard']) ?>"><?= Yii::t('codices', 'Cancel') ?></a>
    </div>
</div>

<?php ActiveForm::end(); ?>

<br />
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <h6><?= Yii::t('codices', 'API Sessions') ?></h6>
            <?=
            GridView::widget([
                'dataProvider' => $filter->search(Yii::$app->request->get()),
                'filterModel' => $filter,
                'layout' => '{items} {summary} {pager}',
                'columns' => [
                        [
                        'attribute' => 'creationDate',
                        'label' => Yii::t('codices', 'Date')
                    ], [
                        'attribute' => 'accessToken',
                        'label' => Yii::t('codices', 'Access Token')
                    ], [
                        'attribute' => 'valid',
                        'label' => Yii::t('codices', 'Valid'),
                        'content' => function($model, $key, $index, $column) {
                            return $model->valid ? '<i class="fa fa-check></i>' : '';
                        },
                        'filter' => [0 => Yii::t('codices', 'No'), 1 => Yii::t('codices', 'Yes')]
                    ], [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'headerOptions' => ['class' => 'action-buttons'],
                        'contentOptions' => ['class' => 'action-buttons'],
                        'buttons' => [
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-trash"></i>', Url::to(['sessions/delete', 'id' => $model->id]), ['class' => 'text-danger', 'data-confirm' => Yii::t('codices', 'Are you sure you want to remove the selected session?')]);
                            }
                        ]
                    ]
                ]
            ])
            ?>
        </div>
    </div>

</div>