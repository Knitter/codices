<?php

/* @var $this yii\web\View */
/* @var $model codices\forms\Author */

$this->title = 'New Author';
$this->params = [
    'tab' => 'authors'
];

echo $this->render('_form', [
    'model' => $model
]);