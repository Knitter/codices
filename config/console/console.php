<?php

$config = [
    'id' => 'console',
    'basePath' => '@console',
    'controllerNamespace' => 'console\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'YiiCtrl',
            'templateFile' => '@console/template/migration.php',
        ],
    ],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => ''
        ]
    ]
];

$prod = realpath(__DIR__ . '/console.prod.php');
if (is_file($prod)) {

    include $prod;
}

$dev = realpath(__DIR__ . '/console.dev.php');
if (defined('YII_DEBUG') && defined('YII_ENV') && YII_DEBUG && YII_ENV == 'dev' &&
    is_file($dev)) {

    include $dev;
}

return $config;
