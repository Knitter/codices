<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Collection */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Collection');
$this->params = [
    'title' => Yii::t('codices', 'Edit Book Collection'),
    'tab' => 'collections'
];

echo $this->render('_form', ['model' => $model]);
