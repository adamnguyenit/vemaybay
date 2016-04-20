<?php

$routes = require __DIR__ . '/routes.php';
$modules = require __DIR__ . '/modules.php';
$db = require __DIR__ . '/db.php';

date_default_timezone_set('Asia/Ho_Chi_Minh');

$config = [
    'id' => 'haiphiyen-api',
    'basePath' => dirname(__DIR__),
    'modules' => $modules,
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'suffix' => '',
            'rules' => $routes,
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'cookieValidationKey' => 'M_h5gRrMgn9lvX0ppkQkJ2CXee4LmCyb',
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'db' => $db,
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'atservice' => [
            'class' => 'app\components\atservice\Service',
            'username' => 'vmbhaiphiyen',
            'password' => 'WEtDGEwa',
        ]
    ],
];

return $config;
