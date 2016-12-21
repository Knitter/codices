<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $series \common\models\Series */

$this->title = Yii::t('codices', 'Series details');
$this->params = [
    'title' => Yii::t('codices', 'Series details')
];

$provider = new ArrayDataProvider([
    'allModels' => $series->books,
    'pagination' => false,
    'sort' => false,
    'key' => function() {
        return false;
    }]);
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['series/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['series/update', 'id' => $series->id]) ?>"><i class="fa fa-pencil"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['series/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr><th>#</th><td><?= $series->id ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Name') ?></th><td><?= $series->name ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Finished') ?></th><td><i class="fa <?= $series->finished ? 'fa-check' : 'fa-times' ?>"></i></td></tr>
        <tr><th><?= Yii::t('codices', 'Owned') ?></th><td><?= $series->ownCount ?></td></tr>
        <tr><th><?= Yii::t('codices', 'Total') ?></th><td><?= $series->bookCount ?></td></tr>
    </table>
</div>

<br />

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
