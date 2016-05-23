<?php

namespace app\assets;

class BookingCompletedAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/booking';
    public $baseUrl = '@web/assets/booking';

    public $css = [
        'css/completed.css',
    ];

    public $js = [
        'js/completed.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
