<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'aval-private-api',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'default/index',
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'cookieValidationKey' => 'Ag0a9fjBjKAVS420BK01eDGH6FoxGWFb',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
        ],
        'user' => [
            'identityClass' => 'common\models\Conta',
            'enableSession' => false,
            'loginUrl' => null
        ]
    ],
    'modules' => [ 'v1' => [ 'class' => 'app\modules\v1\Module']],
    'params' => $params
];

if (is_file(__DIR__ . '/config.override.php')) {
    include __DIR__ . '/config.override.php';
}

return $config;
