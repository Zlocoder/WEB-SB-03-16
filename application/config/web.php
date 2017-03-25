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
        /*
        'myComponent' => [
            'class' => ''
        ],
        */
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dafsgsdfgsdfg',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'admin' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\Admin',
            'enableAutoLogin' => true,
            'loginUrl' => ['admin/site/login']
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/site/login']
        ],
        /*'errorHandler' => [
            'errorAction' => 'site/error',
        ],*/
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
        'assetManager' => [
            'forceCopy' => true
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'onpay' => [
            'class' => 'ejen\payment\Onpay',
            'secret_key' => 'EQnmS8XR1Ta',
            'username' => 'valentkv_beget_tech',
            'url_success' => ['site/index'],
            'url_fail' => ['site/index']
        ]
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
    'defaultRoute' => 'site/site/index',
    'params' => require(__DIR__ . '/params.php'),
    'bootstrap' => ['log'],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'debug';

    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    $config['bootstrap'][] = 'gii';
}

return $config;