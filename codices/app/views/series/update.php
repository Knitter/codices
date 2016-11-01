<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Series */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Series');
$this->params = [
    'title' => Yii::t('codices', 'Edit Book Series'),
    'tab' => 'series'
];

echo $this->render('_form', ['model' => $model]);
