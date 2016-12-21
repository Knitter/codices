<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Account */

$this->title = 'Codices :: ' . Yii::t('codices', 'New account');
$this->params = [
    'title' => Yii::t('codices', 'New account')
];

echo $this->render('_form', ['model' => $model]);
