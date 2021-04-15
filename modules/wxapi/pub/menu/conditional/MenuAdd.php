<?php

namespace wxapi\pub\menu\conditional;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Api;

/**
 * 添加个性化菜单接口
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Personalized_menu_interface.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuAdd extends Api
{

    /**
     * url 路径
     */
    const URL_PATH = '/cgi-bin/menu/addconditional';



    /**
     * 执行创建操作
     *
     * @param array $menus
     * @return \wxapi\pub\base\Result
     *     menuid:  自定义菜单的 ID 值
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