<?php

use common\models\Book;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model codices\forms\Book */
/* @var $series array */
/* @var $publishers array */
/* @var $genres array */

$this->title = 'New Book';
$this->params = [
    'tab' => 'books'
];

echo $this->render('_form', [
    'model' => $model,
    'series' => $series,
    'publishers' => $publishers,
    'genres' => $genres
]);