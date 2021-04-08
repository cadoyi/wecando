<?php

namespace wxapi\pub\menu\conditional;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Api;

/**
 * 删除个性化菜单
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Personalized_menu_interface.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuDel extends Api
{
    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/menu/delconditional';



    /**
     * 执行操作
     *
     * @param int $menuID  创建的个性化菜单 ID
     * @return bool
     */
    public function run( $menuID )
    {
        $url = $this->buildUrl();

        $menu = Json::encode(['menuid' => $menuID]);
        $this->createRequest()
            ->setMethod('POST')
            ->setUrl($url)
            ->setContent($menu)
            ->send();

        return !$this->hasError();
    }


    
}