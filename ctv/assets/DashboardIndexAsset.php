<?php

namespace app\assets;

class DashboardIndexAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/dashboard';
    public $baseUrl = '@web/assets/dashboard';

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
