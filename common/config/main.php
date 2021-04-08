<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
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
