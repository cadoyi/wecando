<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LayoutAsset extends AssetBundle
{


    public $basePath = '@webroot';

    public $baseUrl  = '@web';

    public $css = [
        'layui/css/layui.css',
        'css/layout.css',
        
    ];


    public $js = [
        'layui/layui.all.js',
        'js/layout.js',
    ];





    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
}
