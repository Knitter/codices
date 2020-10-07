<?php

error_reporting(E_ALL);
ini_set('ignore_repeated_errors', true);
ini_set('display_errors', true);
ini_set('log_errors', true);

$debugLevel = 3;

$config['bootstrap'][] = 'log';
$config['components']['log']['traceLevel'] = $debugLevel;
$config['modules']['debug'] = ['class' => 'yii\debug\Module'];
