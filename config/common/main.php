<?php

$config = [
    'name' => 'Codices Book Manager',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=codices',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            // 7 days * 24 hours * 60 minutes * 60 seconds
            'schemaCacheDuration' => 604800,
            'schemaCache' => 'cache'
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\ApcCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ]
    ]
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
