<?php

/* @var $this yii\web\View */
/* @var $model codices\forms\Publisher */

$this->title = 'Edit Publisher';
$this->params = [
    'tab' => 'publishers'
];

echo $this->render('_form', [
    'model' => $model
]);