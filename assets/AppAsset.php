<?php

namespace app\assets;

class AppAsset extends \yii\web\AssetBundle
{

    public $basePath = '@webroot/assets/app';
    public $baseUrl = '@web/assets/app';
    public $css = [
        'css/font-awesome.min.css',
        '//fonts.googleapis.com/css?family=Roboto:300,400,500,700',
        '//fonts.googleapis.com/icon?family=Material+Icons',
        'css/bootstrap.min.css',
        'css/bootstrap-material-design.min.css',
        'css/ripples.min.css',
        'css/bootstrap-datepicker3.min.css',
        'css/custom.css',
        'css/main.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/material.min.js',
        'js/ripples.min.js',
        'js/bootstrap-datepicker.min.js',
        'locales/bootstrap-datepicker.vi.min.js',
        'js/jquery.jscroll.min.js',
        'js/jquery.autocomplete.min.js',
        'js/main.js'
    ];
}
