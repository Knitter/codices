<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=codices',
    'username' => '',
    'password' => '',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    // 7 days * 24 hours * 60 minutes * 60 seconds
    'schemaCacheDuration' => 604800,
    'schemaCache' => 'cache'
];
