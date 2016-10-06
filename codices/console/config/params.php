<?php

return [
    'copy-move' => realpath(__DIR__ . '/../../../data-old'),
    'url-recuperacao' => 'http://www.avaliberica.pt/index.php/conta/alterar-password?k=',
    'assets' => [
        'tools' => realpath(__DIR__ . '/../../../tools'),
        'js' => [
            'merge' => [
                'plugins/countdown/jquery.plugin.min.js',
                'plugins/countdown/jquery.countdown.min.js',
                'plugins/inputmask.custom.3.2.7.min.js',
                'plugins/lightbox2/js/lightbox.min.js',
                'plugins/dropdown/jquery.dropdown.min.js',
                'plugins/icheck/icheck.min.js'
            ],
            'min' => [
                'js/script.js'
            ]
        ],
        'css' => [
            'merge' => [
                'plugins/lightbox2/css/lightbox.min.css',
                'plugins/dropdown/jquery.dropdown.min.css',
                'plugins/icheck/icheck.min.css',
            ],
            'min' => [
                'css/styles.css'
            ]
        ]
    ]
];
