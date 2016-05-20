<?php

namespace app\assets;

class UserLoginAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/user';
    public $baseUrl = '@web/assets/user';

    public $css = [
        'css/login.css',
    ];

    public $js = [
        'js/login.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
