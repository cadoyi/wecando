<?php

namespace wxapi\pub\menu;


use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Api;

/**
 * 创建自定义菜单接口 3x5 菜单
 *   需要用户主动调用来创建自定义菜单
 * 
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuCreate extends Api
{


    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/menu/create';



    /**
     * 创建自定义菜单, 微信刷新频率是 5 分钟
     * 
     * @param $menus  3x5 菜单数组
     *     
     * @return bool  是否创建成功
     */
    public function run( $menus )
    {
        $url = $this->buildUrl();
 
        $menus = Json::encode($menus);

        $this->createRequest()
             ->setMethod('POST')
             ->setUrl($url)
             ->setContent($menus)
             ->send();
        
        return $this->result;
    }






}