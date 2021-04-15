<?php

namespace wxapi\pub\menu;

use Yii;
use wxapi\pub\base\Api;

/**
 * 查询自定义菜单接口
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Querying_Custom_Menus.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuQuery extends Api
{

    /**
     * url 路径
     */
    const URL_PATH = '/cgi-bin/get_current_selfmenu_info';



    /**
     * 查询自定义菜单接口
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