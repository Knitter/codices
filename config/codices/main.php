<?php

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'codices',
    'basePath' => dirname(dirname(__DIR__)) . '/codices',
    'controllerNamespace' => 'codices\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrfweb'
        ],
        'user' => [
            'identityClass' => 'codices\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true
            ]
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'codices'
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages'
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'codices/error'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'cache' => [
                'yii\caching\ApcCache'
            ],
            'rules' => [
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<controller>/<id:\d+>' => '<controller>/details',
                '<module>/<controller>/<action>/<id:\d+>' => '<module>/<controller>/<action>',
            //'<controller>/<slug:[a-zAZ\-]+>/<id:\d+>/<action>' => '<controller>/<action>',
            ]
        ],
    ],
    'modules' => [
        'api/v1' => [
            'class' => 'codices\modules\api\v1\Module'
        ],
    ],
    'params' => $params
];

$dev = realpath(__DIR__ . '/main.dev.php');
if (defined('YII_DEBUG') && defined('YII_ENV') && YII_DEBUG && YII_ENV == 'dev' &&
        is_file($dev)) {

    include $dev;
}

$prod = realpath(__DIR__ . '/main.prod.php');
if (is_file($prod)) {

    include $prod;
}

return $config;
