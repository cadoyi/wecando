<?php

namespace frontend\assets;

use Yii;

/**
 * 资源注册
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AssetBundle extends \yii\web\AssetBundle
{

    public $basePath = '@webroot';
    
    public $baseUrl = '@web';

    public $depends = [
        LayoutAsset::class,
    ];

}