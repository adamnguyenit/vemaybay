<?php

namespace app\assets;

class BookingIndexAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/booking';
    public $baseUrl = '@web/assets/booking';

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
