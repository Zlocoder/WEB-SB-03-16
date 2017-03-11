<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'vendorPath' => __DIR__ . '/../../vendor',
    'runtimePath' => __DIR__ . '/../../runtime',
    'aliases' => [
        '@admin' => '@app/admin',
        '@site' => '@app/site'
    ],
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'yii\base\Module',
            'layout' => 'main',
            'controllerNamespace' => 'admin\controllers',
            'viewPath' => '@admin/views',
            'defaultRoute' => 'site/index'
        ],
        'site' => [
            'class' => 'yii\base\Module',
            'layout' => 'main',
            'controllerNamespace' => 'site\controllers',
            'viewPath' => '@site/views',
            'defaultRoute' => 'site/index'
        ]
    ],
    'params' => require(__DIR__ . '/params.php'),
    'bootstrap' => ['log'],
];

return $config;