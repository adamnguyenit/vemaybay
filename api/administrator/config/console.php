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
    ],
];

return $config;
