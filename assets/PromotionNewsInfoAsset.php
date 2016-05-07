<?php

namespace app\assets;

class PromotionNewsInfoAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/promotion-news';
    public $baseUrl = '@web/assets/promotion-news';

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
