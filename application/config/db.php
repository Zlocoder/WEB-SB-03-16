<?php

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=yii-shop',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ];
} elseif ($_SERVER['HTTP_HOST'] == 'george4e.beget.tech') {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=yii-shop',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ];
}
