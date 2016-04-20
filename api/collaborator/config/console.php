<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$config = [
    'id'                  => 'haiphiyen-api-console',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
];

return $config;
