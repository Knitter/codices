<?php

/* @var $this yii\web\View */
/* @var $model codices\forms\Genre */

$this->title = 'Edit Genre';
$this->params = [
    'tab' => 'genres'
];

echo $this->render('_form', [
    'model' => $model
]);