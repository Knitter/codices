<?php

/* @var $this yii\web\View */
/* @var $model codices\forms\Collection */

$this->title = 'Edit Author';
$this->params = [
    'tab' => 'authors'
];

echo $this->render('_form', [
    'model' => $model
]);