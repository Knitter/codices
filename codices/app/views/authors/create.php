<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Author */

$this->title = 'Codices :: ' . Yii::t('codices', 'New Author');
$this->params = [
    'title' => Yii::t('codices', 'New Book Author'),
    'tab' => 'authors'
];

echo $this->render('_form', ['model' => $model]);
