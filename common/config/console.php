<?php
return [
    'components' => [
        'db'=>[
            'class'=>'yii\db\Connection',
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'tablePrefix' => env('DB_TABLE_PREFIX'),
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],

        'db1'=>[
            'class'=>'yii\db\Connection',
            'dsn' => env('DB1_DSN'),
            'username' => env('DB1_USERNAME'),
            'password' => env('DB1_PASSWORD'),
            'tablePrefix' => env('DB1_TABLE_PREFIX'),
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],
        'db2'=>[
            'class'=>'yii\db\Connection',
            'dsn' => env('DB2_DSN'),
            'username' => env('DB2_USERNAME'),
            'password' => env('DB2_PASSWORD'),
            'tablePrefix' => env('DB2_TABLE_PREFIX'),
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],
    ],
];
