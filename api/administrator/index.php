<?php

// Pass throw OPTIONS verb
$method = 'GET';
if (isset($_SERVER['REQUEST_METHOD'])) {
    $method = $_SERVER['REQUEST_METHOD'];
}
if ($method == 'OPTIONS') {
    exit();
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/config/api.php';

try {
    (new yii\web\Application($config))->run();
} catch (\Exception $e) {
    \yii\helpers\VarDumper::dump($e, 10, true);
}
