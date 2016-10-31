<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $filter \app\models\filters\Series */

$this->title = 'Codices :: ' . Yii::t('codices', 'Book Series');
$this->params = [
    'title' => Yii::t('codices', 'Book Series'),
    'search' => ['series/index'],
    'tab' => 'series'
];
?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body no-padding">
                <?=
                GridView::widget([
                    'dataProvider' => $filter->search(Yii::$app->request->get()),
                    'layout' => '{items} {summary} {pager}',
                    'columns' => [
                        'id',
                        'name'
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>