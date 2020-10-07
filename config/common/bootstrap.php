<?php

$parent = dirname(dirname(__DIR__));

Yii::setAlias('@common', $parent . '/common');
Yii::setAlias('@codices', $parent . '/codices');
Yii::setAlias('@console', $parent . '/console');
