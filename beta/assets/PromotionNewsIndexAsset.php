<?php

namespace app\assets;

class PromotionNewsIndexAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/promotion-news';
    public $baseUrl = '@web/assets/promotion-news';

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
