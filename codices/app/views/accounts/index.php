<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $filter \app\models\filters\Accounts */

$this->title = 'Codices :: ' . Yii::t('codices', 'User Accounts');
$this->params = [
    'title' => Yii::t('codices', 'User Accounts'),
    'tab' => 'accounts'
];
?>

<div class="btn-group pull-right">
    <a class="btn" href="<?= Url::to(['accounts/create']) ?>"><i class="fa fa-plus"></i></a>
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
            ], [
                'attribute' => 'name',
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->name, Url::to(['accounts/view', 'id' => $model->id]));
                }
            ], [
                'attribute' => 'email',
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->email, Url::to(['accounts/view', 'id' => $model->id]));
                }
            ], [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'headerOptions' => ['class' => 'action-buttons'],
                'contentOptions' => ['class' => 'action-buttons'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::to(['accounts/update', 'id' => $model->id]), ['class' => 'text-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', Url::to(['accounts/delete', 'id' => $model->id]), ['class' => 'text-danger', 'data-confirm' => Yii::t('codices', 'Are you sure you want to remove the selected account?')]);
                    }
                ]
            ]
        ]
    ])
    ?>
</div>
