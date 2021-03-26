<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => require __DIR__ . '/main/modules.php',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'logger' => [
            'class' => 'core\log\Logger',
            'tableConfig' => [
                'filename' => '@common/config/main/logger',
            ],
        ],
    ],
];
