<?php

namespace app\assets;

class BookingUncompletedAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/booking';
    public $baseUrl = '@web/assets/booking';

    public $css = [
        'css/uncompleted.css',
    ];

    public $js = [
        'js/uncompleted.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
