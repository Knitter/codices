<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
//-
use common\models\Author;

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Series */

$authors = [0 => Yii::t('codices', '- none -')] + ArrayHelper::map(Author::find()
                        ->orderBy(['(CONCAT(name, " ", surname))' => SORT_ASC])
                        ->all(), 'id', 'fullName');

$this->registerJs("$('input[type=\"checkbox\"]').iCheck({ checkboxClass: 'icheckbox_square-aero' });");

$provider = new ArrayDataProvider([
    'allModels' => $model->books,
    'pagination' => false,
    'sort' => false,
    'key' => function() {
        return false;
    }]);

$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'role' => 'form']]);
?>

<?=
$form->field($model, 'name', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8">{input}</div>'
])->textInput(['class' => 'form-control'])
?>

<?=
$form->field($model, 'authorId', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-8">{input}</div>'
])->dropDownList($authors, ['class' => 'form-control'])
?>

<?=
$form->field($model, 'bookCount', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-3">{input}</div>'
])->textInput(['class' => 'form-control', 'placeholder' => Yii::t('codices', 'Number of released books')])
?>

<?=
$form->field($model, 'finished', [
    'labelOptions' => ['class' => 'col-md-2 control-label'],
    'template' => '{label}<div class="col-md-3">{input}</div>'
])->checkbox(null, false)
?>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <button class="btn btn-success" type="submit"><?= Yii::t('codices', 'Submit') ?></button>
        <a class="form-cancel-btn text-warning" href="<?= Url::to(['series/index']) ?>"><?= Yii::t('codices', 'Cancel') ?></a>
    </div>
</div>

<?php ActiveForm::end() ?>

<div class="table-responsive">
    <h6><?= Yii::t('codices', 'Books in series') ?></h6>
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
                'attribute' => 'authorName',
                'label' => Yii::t('codices', 'Author'),
                'content' => function($model, $key, $index, $column) {
                    return $model->authorId ? $model->author->fullName : '';
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
