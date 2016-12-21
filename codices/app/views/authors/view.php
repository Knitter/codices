<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $author \common\models\Author */

$this->title = Yii::t('codices', 'Author details');
$this->params = [
    'title' => Yii::t('codices', 'Author details')
];

$provider = new ArrayDataProvider([
    'allModels' => $author->books,
    'pagination' => false,
    'sort' => false,
    'key' => function() {
        return false;
    }]);
?>

<div class="btn-group pull-right">
    <a class="btn btn-default" href="<?= Url::to(['authors/index']) ?>"><i class="fa fa-list"></i></a>
    <a class="btn btn-primary" href="<?= Url::to(['authors/update', 'id' => $author->id]) ?>"><i class="fa fa-pencil"></i></a>
    <a class="btn btn-success" href="<?= Url::to(['authors/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <td><?= $author->id ?></td>
            <td rowspan="4" class="text-center" style="width: 180px;">
                <?php if (($url = $author->photoURL)) { ?>
                    <img class="img-rounded preview" src="<?= $url ?>">
                <?php } ?>
            </td>
        </tr>

        <tr><th><?= Yii::t('codices', 'Name') ?></th><td><?= $author->fullName ?></td></tr>

        <tr>
            <th><?= Yii::t('codices', 'Website/URL') ?></th>
            <td>
                <?php if ($author->url) { ?>
                    <a href="<?= $author->url ?>" target="_blank"><?= $author->url ?> <i class="fa fa-external-link"></i></a>
                <?php } ?>
            </td>
        </tr>

        <tr><th><?= Yii::t('codices', 'Biography') ?></th><td><?= $author->biography ?></td></tr>
    </table>
</div>

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
