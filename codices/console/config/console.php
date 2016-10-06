<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'codices-console',
    'basePath' => dirname(__DIR__),
    'components' => [
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'pt-PT',
                    'basePath' => '@app/messages'
                ]
            ]
        ],
    ],
    'params' => $params,
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'YiiMigrationCtl',
            'templateFile' => '@console/views/migration.php',
            'migrationPath' => '@container/migrations',
            'interactive' => 0
        ]
    ]
];

return $config;

