<?php

namespace app\assets;

class FlightBookAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/flight';
    public $baseUrl = '@web/assets/flight';

    public $css = [
        'css/book.css',
    ];

    public $js = [
        'js/book.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
