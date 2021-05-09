<?php

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{

    public $basePath = '@webroot/lib/font-awesome';

    public $baseUrl = '@web/lib/font-awesome';


    public $css = [
        'css/font-awesome.min.css',
    ];


}