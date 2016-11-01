<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Collection */

$this->title = 'Codices :: ' . Yii::t('codices', 'New Collection');
$this->params = [
    'title' => Yii::t('codices', 'New Book Collection'),
    'tab' => 'collections'
];

echo $this->render('_form', ['model' => $model]);
