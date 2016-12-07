<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Author */

$provider = new ArrayDataProvider([
    'allModels' => $model->books,
    'pagination' => false,
    'sort' => false,
    'key' => function() {
        return false;
    }]);

$inputFieldOptions = [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-10">{input}</div>'
];

$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form']]);
?>

<?= $form->field($model, 'name', $inputFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'surname', $inputFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'url', $inputFieldOptions)->textInput(['class' => 'form-control']) ?>

<?= $form->field($model, 'biography', $inputFieldOptions)->textarea(['class' => 'form-control']) ?>

<?= $form->field($model, 'photo', $inputFieldOptions)->fileInput() ?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['authors/index']) ?>"><?= Yii::t('codices', 'Cancel') ?></a>
    </div>
</div>

<?php ActiveForm::end() ?>

<div class="table-responsive">
    <h6><?= Yii::t('codices', 'Books written by the author') ?></h6>
    <?=
    GridView::widget([
        'dataProvider' => $provider,
        'layout' => '{items} {summary}',
        'columns' => [
                [
                'attribute' => 'title',
                'label' => Yii::t('codices', 'Title'),
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->title, Url::to(['books/view', 'id' => $model->id]));
                }
            ], [
                'attribute' => 'seriesName',
                'label' => Yii::t('codices', 'Series'),
                'content' => function($model, $key, $index, $column) {
                    return $model->seriesId ? Html::a($model->series->name, Url::to(['series/view', 'id' => $model->seriesId])) : '';
                }
            ], [
                'attribute' => 'isbn',
                'label' => Yii::t('codices', 'ISBN')
            ], [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'headerOptions' => ['class' => 'action-buttons'],
                'contentOptions' => ['class' => 'action-buttons'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-eye"></i>', Url::to(['books/view', 'id' => $model->id]), ['class' => 'btn btn-xs btn-default']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::to(['books/update', 'id' => $model->id]), ['class' => 'btn btn-xs btn-primary']);
                    }
                ]
            ]
        ]
    ])
    ?>
</div>
