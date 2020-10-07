<?php

return [
    'sourcePath' => dirname(dirname(__DIR__)) . '/codices',
    'languages' => ['pt'],
    'translator' => 'Yii::t',
    'sort' => false,
    'removeUnused' => false,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/assets',
        '/commands',
        '/config',
        '/messages',
        '/migrations',
        '/runtime',
        '/tests'
    ],
    'format' => 'php',
    'messagePath' => dirname(dirname(__DIR__)) . '/codices/messages',
    'overwrite' => true
];
