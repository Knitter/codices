<?php

/* @var $this \yii\web\View */
/* @var $books \common\models\Book[] */

$this->title = Yii::t('codices', 'Book Gallery');

echo $this->render('_gallery-' . $type, ['books' => $books]);
