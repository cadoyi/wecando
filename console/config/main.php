<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => require __DIR__ . '/modules/modules.php',
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@app/migrations',
            ],
            'templateFile' =>  '@core/db/migrate/views/migration.php',
            'generatorTemplateFiles' => [
                'create_table'    => '@core/db/migrate/views/createTableMigration.php',
                'drop_table'      => '@core/db/migrate/views/dropTableMigration.php',
                'add_column'      => '@core/db/migrate/views/addColumnMigration.php',
                'drop_column'     => '@core/db/migrate/views/dropColumnMigration.php',
                'create_junction' => '@core/db/migrate/views/createTableMigration.php',
            ],
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
