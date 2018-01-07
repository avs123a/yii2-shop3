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
        //'css/site.css',
		'css/bootstrap1.css',
		'css/skdslider.css',
		'css/style.css',
    ];
    public $js = [
	    'js/bootstrap.min.js',
		'js/easing.js',
		'js/minicart.min.js',
		'js/move-top.js',
		'js/jquery-1.11.1.min.js',
		'js/responsiveslides.min.js',
		'js/skdslider.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
