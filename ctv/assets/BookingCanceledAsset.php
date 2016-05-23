<?php

namespace app\assets;

class BookingCanceledAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/booking';
    public $baseUrl = '@web/assets/booking';

    public $css = [
        'css/canceled.css',
    ];

    public $js = [
        'js/canceled.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
