<?php

use common\models\Book;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */
/* @var $filter codices\filters\Accounts */
/* @var $series array */

$this->title = 'Accounts';
$this->params = [
    'tab' => 'accounts'
];
?>

<div class="card">
    <div class="card-body">
        <?=
        GridView::widget([
            'dataProvider' => $provider,
            'filterModel' => $filter,
            'layout' => '<div class="table-responsive">{errors} {items}</div><div class="d-flex align-items-center">{summary} {pager}</div>',
            'tableOptions' => ['class' => 'table card-table table-vcenter text-nowrap datatable'],
            'pager' => [
                'options' => ['class' => 'pagination m-0 ms-auto'],
                'linkOptions' => ['class' => 'page-link'],
                'linkContainerOptions' => ['class' => 'page-item'],
                'disabledListItemSubTagOptions' => [
                    'tag' => 'a',
                    'href' => '#',
                    'class' => 'page-link'
                ]
            ],
            'columns' => [
                [
                    'attribute' => 'name',
                    'content' => function ($model) {
                        return Html::a($model->name, ['edit', 'id' => $model->id]);
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'email',
                    'content' => function ($model) {
                        return $model->email ?: '';
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'login',
                    'content' => function ($model) {
                        return $model->login ?: '';
                    },
                    'filterInputOptions' => ['class' => 'form-control form-control-sm', 'id' => null]
                ],
                [
                    'attribute' => 'active',
                    'headerOptions' => ['class' => 'account-active-col-header'],
                    'contentOptions' => ['class' => 'account-active-col-cell'],
                    'content' => function ($model) {
                        if ($model->active) {
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>';
                        }

                        return '';
                    },
                    'filter' => ['yes' => Yii::t('codices', 'Yes'), 'no' => Yii::t('codices', 'No')],
                    'filterInputOptions' => ['class' => 'form-select form-select-sm', 'id' => null]
                ],
            ]
        ])
        ?>
    </div>
</div>
