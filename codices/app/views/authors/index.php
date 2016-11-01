<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $filter \app\models\filters\Authors */

$this->title = 'Codices :: ' . Yii::t('codices', 'Authors');
$this->params = [
    'title' => Yii::t('codices', 'Author List'),
    'search' => ['authors/index'],
    'tab' => 'authors'
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['authors/create']) ?>"><i class="fa fa-plus"></i></a>
</div>

<div class="clearfix"></div><br />

<div class="table-responsive">
    <?=
    GridView::widget([
        'dataProvider' => $filter->search(Yii::$app->request->get()),
        'layout' => '{items} {summary} {pager}',
        'columns' => [
                [
                'attribute' => 'id',
                'label' => '#',
                'headerOptions' => ['class' => 'id-column']
            ],
                [
                'attribute' => 'fullName',
                'label' => 'Name',
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->fullName, Url::to(['authors/view', 'id' => $model->id]));
                }
            ],
                [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['class' => 'action-buttons'],
                'contentOptions' => ['class' => 'action-buttons'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::to(['authors/update', 'id' => $model->id]), ['class' => 'text-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', Url::to(['authors/delete', 'id' => $model->id]), ['class' => 'text-danger', 'data-confirm' => Yii::t('codices', 'Are you sure you want to remove the selected author?')]);
                    }
                ]
            ]
        ]
    ])
    ?>
</div>
