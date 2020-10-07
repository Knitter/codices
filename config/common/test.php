<?php

return [
    'id' => 'common-tests',
    'basePath' => dirname(dirname(__DIR__)) . '/common',
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],
    ],
];
