<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $filter \app\models\filters\Books */

$this->title = 'Codices :: ' . Yii::t('codices', 'Books');
$this->params = [
    'title' => Yii::t('codices', 'Books'),
    'search' => ['books/index'],
    'tab' => 'books'
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
                        'title',
                        'isbn'
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>