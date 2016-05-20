<?php

Yii::setAlias('@tests', dirname(__DIR__).'/tests');

$db = require __DIR__ . '/db.php';
$modules = require __DIR__ . '/modules.php';

$config = [
    'id' => 'haiphiyen-api-administrator-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
    'components' => [
        'db' => $db,
        'atservice' => [
            'class' => 'app\components\atservice\Service',
            'username' => 'vmbhaiphiyen',
            'password' => 'WEtDGEwa',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                /*
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.vemaybayhaiphiyen.com',
                'username' => 'no-reply@vemaybayhaiphiyen.com',
                'password' => 'vemaybayhaiphiyen2016',
                'port' => 465,
                'encryption' => 'ssl',
                */
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.gmail.com',
                'username'   => 'vemaybayhaiphiyen@gmail.com',
                'password'   => '101080dao',
                'port'       => 587,
                'encryption' => 'tls',
            ],
        ],
    ],
    'params' => [
        'serverEmail' => 'vemaybayhaiphiyen@gmail.com',
        'adminEmail' => [
            'haiphiyencoltd@gmail.com',
            'adamnguyen.itdn@gmail.com'
        ]
    ]
];

return $config;
