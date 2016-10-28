<?php

$params = [];
if (is_file(__DIR__ . '/params.php')) {
    $params = require(__DIR__ . '/params.php');
}

$config = [
    'id' => 'codices-app',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'dashboard',
    'components' => [
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages'
                ]
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true
        ],
        'request' => [ 'cookieValidationKey' => '0SyovBjBjvnVapjq07fal12ShC0BKrVeD#Fb'],
        'user' => [
            'identityClass' => 'common\models\Account',
            'enableAutoLogin' => true,
            'loginUrl' => ['dashboard/login']
        ],
        'errorHandler' => [
            'errorAction' => 'dashboard/error'
        ]
    ],
    'params' => $params
];

return $config;