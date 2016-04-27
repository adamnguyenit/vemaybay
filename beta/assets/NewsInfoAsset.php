<?php

namespace app\assets;

class NewsInfoAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/news';
    public $baseUrl = '@web/assets/news';

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
