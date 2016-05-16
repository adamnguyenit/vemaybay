<?php

namespace app\assets;

class FlightResultAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/flight';
    public $baseUrl = '@web/assets/flight';

    public $css = [
        'css/result.css',
    ];

    public $js = [
        'js/result.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
