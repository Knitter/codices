<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Account */

$this->title = 'Codices :: ' . Yii::t('codices', 'New Account');
$this->params = [
    'title' => Yii::t('codices', 'New User Account')
];

echo $this->render('_form', ['model' => $model]);
