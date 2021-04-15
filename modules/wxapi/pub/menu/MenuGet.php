<?php

namespace wxapi\pub\menu;

use Yii;
use wxapi\pub\base\Api;

/**
 * 获取自定义菜单配置
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Getting_Custom_Menu_Configurations.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuGet extends Api
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/menu/get';



    /**
     * 执行自定义菜单
     *
     * @return \wxapi\pub\base\Result
     * 
     */
    public function run()
    {
        $url = $this->buildUrl();
        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();
        return $this->result;
    }

}