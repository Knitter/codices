<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Book */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Book');
$this->params = [
    'title' => Yii::t('codices', 'Edit Book'),
    'tab' => 'books'
];

echo $this->render('_form', ['model' => $model]);
