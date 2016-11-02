<?php

$db = require(__DIR__ . '/db.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'version' => '1.0.1',
    'vendorPath' => __DIR__ . '/../../../vendor',
    'components' => [
        'cache' => ['class' => 'yii\caching\FileCache'],
        'db' => $db
    ],
    'params' => $params
];

if (defined('YII_DEBUG')) {
    $config['components']['log'] = [
        'traceLevel' => 3,
        'targets' => [
                [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning']
            ]
        ]
    ];
}

if (defined('YII_ENV') && YII_ENV == 'dev' && is_file(__DIR__ . '/config.local.php')) {
    include __DIR__ . '/config.local.php';
}

return $config;
