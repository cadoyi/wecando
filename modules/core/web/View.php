<?php

namespace core\web;

use Yii;
use core\widgets\Script;

/**
 * 视图组件
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class View extends \yii\web\View
{


    /**
     * 脚本开始
     *
     * @param array $config  附加的配置
     * @return Script
     */
    public function beginScript( $config = [] )
    {
        return Script::begin( $config );
    }


    /**
     * 脚本结束
     *
     * @return Script
     */
    public function endScript()
    {
        return Script::end();
    }

}