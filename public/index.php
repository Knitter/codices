<?php

$environment = 'prod';
$env = realpath(__DIR__ . '/../_ENV');
if (is_file($env)) {
    $environment = trim(file_get_contents($env));
}

if ($environment === 'development') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
} else if ($environment === 'test') {

    if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
        die('You are not allowed to access this file.');
    }

    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'test');

    //TODO: test system setup
    return;
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../config/common/main.php',
    require __DIR__ . '/../config/codices/web.php'
);

(new grupoerofio\components\Application($config))->run();
