<?php
$routes = require __DIR__ . '/routes.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

$config = [
    'id' => 'haiphiyen-ctv',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'suffix' => '.html',
            'rules' => $routes,
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'cookieValidationKey' => 'M_h5gRrMgn9lvX0ppkQkJ2CXee4LmCyb',
            'enableCsrfValidation' => false
        ],
    ],
];

return $config;
