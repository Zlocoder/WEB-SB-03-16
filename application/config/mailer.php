<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    return [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        //'htmlLayout' => 'specific html layout',
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'siamondrewards@gmail.com',
            'password' => 'diamondrewards123',
            'port' => '587',
            'encryption' => 'tls',
        ]
    ];
}