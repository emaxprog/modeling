<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://www.gstatic.com/charts/loader.js',
        'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons',
        'css/material-dashboard.css?v=2.1.0',
        'demo/demo.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public $js = [
        'https://www.gstatic.com/charts/loader.js',
        'js/script.js',
        'js/core/jquery.min.js',
        'js/core/popper.min.js',
        'js/core/bootstrap-material-design.min.js',
        'js/material-dashboard.min.js',
        'demo/demo.js',
    ];
}
