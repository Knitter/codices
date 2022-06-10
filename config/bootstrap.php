<?php

$parent = dirname(__DIR__, 1);

Yii::setAlias('@container', $parent);
Yii::setAlias('@build', $parent . '/build');
Yii::setAlias('@codices', $parent . '/codices');
Yii::setAlias('@common', $parent . '/common');
Yii::setAlias('@config', $parent . '/config');
Yii::setAlias('@console', $parent . '/console');
Yii::setAlias('@docs', $parent . '/docs');

Yii::setAlias('@bundle', $parent . '/codices/assets/bundle');

