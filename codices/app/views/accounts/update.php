<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\forms\Account */

$this->title = 'Codices :: ' . Yii::t('codices', 'Edit account');
$this->params = [
    'title' => Yii::t('codices', 'Edit account')
];

echo $this->render('_form', ['model' => $model]);
