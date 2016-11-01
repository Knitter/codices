<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Account */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit Account');
$this->params = [
    'title' => Yii::t('codices', 'Edit User Account')
];

echo $this->render('_form', ['model' => $model]);
