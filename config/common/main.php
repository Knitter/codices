<?php

use yii\symfonymailer\Mailer;

$config = [
    'name' => 'Codices Book Manager',
    'vendorPath' => '@container/vendor',
    'aliases' => [
        '@bower' => '@container/vendor/bower-asset',
        '@npm' => '@container/vendor/npm-asset',
    ],
    'sourceLanguage' => 'pt-PT',
    'language' => 'pt-PT',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\ApcCache',
            'useApcu' => true
        ],
        'mailer' => [
            'class' => Mailer::class,
            'useFileTransport' => true,
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'localhost',
                'port' => 25,
                'options' => ['ssl' => false]
            ],
        ],
        'log' => [
            'traceLevel' => 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=codices',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => (24 * 60 * 60),
            'schemaCache' => 'cache'
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'timeout' => (4 * 60 * 60)
        ],
    ]
];

$prod = realpath(__DIR__ . '/main.prod.php');
if (is_file($prod)) {

    include $prod;
}

$dev = realpath(__DIR__ . '/main.dev.php');
if (defined('YII_DEBUG') && defined('YII_ENV') && YII_DEBUG && YII_ENV == 'dev' &&
    is_file($dev)) {

    include $dev;
}

return $config;
