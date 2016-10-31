<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $filter \app\models\filters\Authors */

$this->title = 'Codices :: ' . Yii::t('codices', 'Authors');
$this->params = [
    'title' => Yii::t('codices', 'Author List'),
    'search' => ['authors/index'],
    'tab' => 'authors'
];
?>

<div class="table-responsive">
    <?=
    GridView::widget([
        'dataProvider' => $filter->search(Yii::$app->request->get()),
        'layout' => '{items} {summary} {pager}',
        'columns' => [
            'id',
            'fullName'
        ]
    ])
    ?>
</div>