<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $filter \app\models\filters\Books */

$this->title = 'Codices :: ' . Yii::t('codices', 'Books');
$this->params = [
    'title' => Yii::t('codices', 'Book List'),
    'search' => ['books/index'],
    'tab' => 'books'
];
?>

<div class="table-responsive">
    <?=
    GridView::widget([
        'dataProvider' => $filter->search(Yii::$app->request->get()),
        'filterModel' => $filter,
        'layout' => '{items} {summary} {pager}',
        'columns' => [
            'id',
            'title',
            'isbn',
            'series.name'
        ]
    ])
    ?>
</div>