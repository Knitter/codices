<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'codices-rest',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'default/index',
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'cookieValidationKey' => 'Ag0a9fjBjKAVS420BSGAAafaK01eDGH6FoxGWFb',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => [
                    ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/book', 'v1/author', 'v1/collection']],
                    ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/series', 'v1/account'], 'pluralize' => false]
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\Account',
            'enableSession' => false,
            'loginUrl' => null
        ]
    ],
    'modules' => ['v1' => ['class' => 'app\modules\v1\Module']],
    'params' => $params
];

return $config;
