<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=he_thong_quan_ly_van_ban',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com', //smtp.gmail.com
                'username' => 'fifaonline1705@gmail.com', //fifaonline1705@gmail.com
                'password' => 'namdeptrai', //namdeptrai
                'port' => '587', //587
                'encryption' => 'tls', //tls
            ],
        ],
    ],
];
