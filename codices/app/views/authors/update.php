<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Author */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Author');
$this->params = [
    'title' => Yii::t('codices', 'Edit Author'),
    'tab' => 'authors'
];

echo $this->render('_form', ['model' => $model]);
