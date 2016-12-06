<?php

/* @var $this \yii\web\View */
/* @var $books \common\models\Book[] */

$this->title = 'Codices :: ' . Yii::t('codices', 'Gallery');

echo $this->render('_gallery-' . $type);
