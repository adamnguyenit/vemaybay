<?php

namespace app\assets;

class NewsIndexAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/news';
    public $baseUrl = '@web/assets/news';

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
