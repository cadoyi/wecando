<?php

namespace frontend\assets;

use Yii;

/**
 * 布局文件路径
 * 
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class LayoutAsset extends AssetBundle
{

    public $css = [
        'css/base.css',
        'css/layout.css',
    ];


    public $js = [
        'js/base.js',
        'js/layout.js',
    ]; 



    public $depends = [
       'yii\web\YiiAsset',
       'yii\web\JqueryAsset',
       'yii\bootstrap4\BootstrapPluginAsset',
       FontAwesomeAsset::class,
    ];
}