<?php

/* @var $this yii\web\View */
/* @var $model codices\forms\Series */

$this->title = 'New Book Series';
$this->params = [
    'tab' => 'series'
];

echo $this->render('_form', [
    'model' => $model
]);