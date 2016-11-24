<?php

$params = [];
if (is_file(__DIR__ . '/params.php')) {
    $params = require(__DIR__ . '/params.php');
}

$config = [
    'id' => 'codices-app',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'codices',
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => ['_assets/js/jquery-3.1.1.min.js']
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => ['_assets/js/bootstrap.min.js'],
                    'css' => ['_assets/css/bootstrap.min.css']
                ]
            ]
        ],
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
        'request' => ['cookieValidationKey' => '0SyovBjBjvnVapjq07fal12ShC0BKrVeD#Fb'],
        'user' => [
            'identityClass' => 'common\models\Account',
            'enableAutoLogin' => true,
            'loginUrl' => ['codices/login']
        ],
        'errorHandler' => [
            'errorAction' => 'codices/error'
        ]
    ],
    'params' => $params
];

return $config;
