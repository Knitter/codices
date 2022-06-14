<?php

/* @var $this yii\web\View */
/* @var $model codices\forms\Collection */

$this->title = 'Edit Book Collection';
$this->params = [
    'tab' => 'collections'
];

echo $this->render('_form', [
    'model' => $model
]);