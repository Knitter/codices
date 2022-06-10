<?php

$config = [
    'id' => 'codices',
    'basePath' => '@codices',
    'controllerNamespace' => 'codices\controllers',
    'defaultRoute' => 'site/dashboard',
    'components' => [
        'view' => [
            'class' => 'codices\components\View',
        ],
        'request' => [
            'csrfParam' => '_csrfweb',
            'cookieValidationKey' => 'YlV8KprFK7TMDxhZDZC50peVGGVIGlfC',
//            'parsers' => [
//                'application/json' => 'yii\web\JsonParser',
//            ]
        ],
        'user' => [
            'identityClass' => 'codices\models\User',
            'enableSession' => true,
            'enableAutoLogin' => false,
            'loginUrl' => ['site/login'],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages'
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'cache' => [
                'class' => 'yii\caching\ApcCache',
                'useApcu' => true
            ],
            'rules' => [
                //'<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                //'<controller>/<id:\d+>' => '<controller>/details',
               // '<module>/<controller>/<action>/<id:\d+>' => '<module>/<controller>/<action>',
                //'<controller>/<slug:[a-zAZ\-]+>/<id:\d+>/<action>' => '<controller>/<action>',
            ]
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => ['css' => []]
            ]
        ]
    ],
    'modules' => [
        'api/v1' => [
            'class' => 'codices\modules\api\v1\Module',
            'defaultRoute' => 'visit/index'
        ],
    ]
];

$prod = realpath(__DIR__ . '/web.prod.php');
if (is_file($prod)) {

    include $prod;
}

$dev = realpath(__DIR__ . '/web.dev.php');
if (defined('YII_DEBUG') && defined('YII_ENV') && YII_DEBUG && YII_ENV == 'dev' &&
    is_file($dev)) {

    include $dev;
}

return $config;
