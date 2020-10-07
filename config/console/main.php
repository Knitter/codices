<?php

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'console',
    'basePath' => dirname(dirname(__DIR__)) . '/console',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
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
