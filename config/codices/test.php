<?php

return [
    'id' => 'codices-tests',
    'components' => [
        'assetManager' => [
            'basePath' => dirname(dirname(__DIR__)) . '/public/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test'
        ]
    ]
];
