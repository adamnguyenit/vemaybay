<?php

namespace app\assets;

class BookingInfoAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/booking';
    public $baseUrl = '@web/assets/booking';

    public $css = [
        'css/info.css',
    ];

    public $js = [
        'js/info.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
