<?php

namespace app\assets;

class FlightSearchAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/flight';
    public $baseUrl = '@web/assets/flight';

    public $css = [
        'css/datatables.min.css',
        'css/search.css',
    ];

    public $js = [
        'js/datatables.min.js',
        'js/search.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
