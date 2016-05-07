<?php

namespace app\assets;

class FlightIndexAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/flight';
    public $baseUrl = '@web/assets/flight';

    public $css = [
        'css/index.css',
    ];

    public $js = [
        'js/index.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
