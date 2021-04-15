<?php

namespace wxapi\pub\menu;

use Yii;
use wxapi\pub\base\Api;

/**
 * 自定义菜单删除接口
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Deleting_Custom-Defined_Menu.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuDelete extends Api
{

    /**
     * url 路径
     */
    const URL_PATH = '/cgi-bin/menu/delete';




    /**
     * 执行接口操作
     *
     * @return \wxapi\pub\base\Result
     */
    public function run()
    {
        $url = $this->buildUrl();

        $this->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->send();
        return $this->getResult();
    }

    

}