<?php

use yii\helpers\ArrayHelper;

$config = ArrayHelper::merge(require __DIR__ . '/main.php', [
    'id' => 'common-tests',
    'basePath' => '@common',
    'components' => [
        'mailer' => [
            'useFileTransport' => true
        ]
    ]
]);

$test = realpath(__DIR__ . '/main.test.php');
if (defined('YII_DEBUG') && defined('YII_ENV') && YII_DEBUG && YII_ENV == 'test' &&
    is_file($test)) {

    include $test;
}

return $config;