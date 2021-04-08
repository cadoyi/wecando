<?php

namespace wxapi\pub\menu\conditional;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Api;

/**
 * 个性化菜单的匹配测试
 * 
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Personalized_menu_interface.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuMatch extends Api
{

    /**
     * url 路径
     */
    const URL_PATH  = '/cgi-bin/menu/trymatch';



    /**
     * 执行操作
     *
     * @param string $openid 用户的 openid
     * @return \wxapi\pub\httpclient\Data 返回匹配的个性化菜单
     */
    public function run( $openid )
    {
        $url = $this->buildUrl();

        $content = Json::encode(["user_id" => $openid]);
        $this->createRequest()
             ->setMethod('POST')
             ->setUrl($url)
             ->setContent($content)
             ->send();

        return $this->getData();
    }

}