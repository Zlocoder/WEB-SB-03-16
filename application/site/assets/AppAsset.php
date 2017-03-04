<?php

namespace site\assets;

class AppAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@site/views/assets';

    public $css = [
        'css/ddsmoothmenu.css',
        'css/slimbox2.css',
        'nivo-slider.css',
        'templatemo_style.css'
    ];

    public $js = [
        'js/ddsmoothmenu.js',
        'js/jquery.nivo.slider.pack.js',
        'js/slimbox2.js',
        'js/main.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}