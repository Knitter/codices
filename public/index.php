<?php

$env = '';
$envString = 'prod';

$envFile = realpath(__DIR__ . '/../CODICES_ENV');
if (is_file($envFile)) {
    $env = trim(file_get_contents($envFile));
}

if ($env === 'development') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
} else if ($env === 'test') {

    if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
        die('You are not allowed to access this file.');
    }

    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'test');

    //TODO: test system setup
    //$config = yii\helpers\ArrayHelper::merge(
    //require __DIR__ . '/../../common/config/main.php',
    //require __DIR__ . '/../../common/config/main-local.php',
    //require __DIR__ . '/../../common/config/test.php',
    //require __DIR__ . '/../../common/config/test-local.php',
    //require __DIR__ . '/../config/main.php',
    //require __DIR__ . '/../config/main-local.php',
    //require __DIR__ . '/../config/test.php',
    //require __DIR__ . '/../config/test-local.php'
    //);

    return;
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/common/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
                require __DIR__ . '/../config/common/main.php',
                require __DIR__ . '/../config/codices/main.php'
);

(new yii\web\Application($config))->run();
