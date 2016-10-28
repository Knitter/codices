<?php

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

define('YII_DEBUG', true);
define('YII_ENV', 'test');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../codices/common/config/bootstrap.php');

//TODO: 
//$config = require(__DIR__ . '/../../tests/codeception/config/backend/acceptance.php');
(new yii\web\Application($config))->run();
