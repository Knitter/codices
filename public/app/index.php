<?php

//NOTE: Reverting to simple flag setting for now
//if (is_file(realpath(__DIR__ . '/../../vagrant.config.lock'))) {
//
//    defined('YII_DEBUG') or define('YII_DEBUG', true);
//    defined('YII_ENV') or define('YII_ENV', 'dev');
//}

define('YII_DEBUG', true);
define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../codices/common/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(require(__DIR__ . '/../../codices/common/config/main.php')
                , require(__DIR__ . '/../../codices/app/config/main.php'));
(new yii\web\Application($config))->run();