<?php

namespace frontend\controllers\weixin;

use frontend\controllers\Controller;
use Yii;

/**
 * 微信公众号 API 入口
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class PubController extends Controller
{

    public $enableCsrfValidation = false;



    /**
     * 微信操作入口程序,被动接受微信通知
     *
     * @return void
     */
    public function actionCallback()
    {
        $echostr = $this->getServer()->getEchoStr();
        if (!Yii::$app->request->isPost && is_string($echostr)) {
            return $echostr;
        }
        if ($echostr === false) {
            return $this->notFound();
        }
        $request = $this->getServer()->getRequest();
        echo 'success';
        die;

        //Yii::error(->getRawData());
    }



    public function actionToken($refresh = 0)
    {
        if ($refresh) {
            return $this->getServer()->refreshAccessToken();
        }
        return $this->getServer()->getAccessToken();
    }




    /**
     * 创建自定义菜单
     *
     * @return void
     */
    public function actionCreateMenu()
    {
        $menus = [
            'button' => [
                [
                    'type' => 'click',
                    'name' => '今日歌曲',
                    'key'  => 'today_music',
                ],
                [
                    'name' => '顶级菜单',
                    'sub_button' => [
                        [
                            'type' => 'view',
                            'name' => '二级菜单',
                            'url'  => 'http://weixin.cadoyi.com/weixin/pub/index.html',
                        ],
                        [
                            "type" => "click",
                            "name" => "赞一下我们",
                            "key" => "V1001_GOOD"
                        ]
                    ]
                ]
            ]
        ];
/*
        $menus = '{
            "button": [
                {
                    "type": "view",
                    "name": "官方商城",
                    "url": "https://mall.telunsu.net/telunsu/himilk/product/index.html?vcome=wxmenu"
                },
                {
                    "name": "会员社区",
                    "sub_button":  [
                        {
                            "type": "view",
                            "name": "会员社区",
                            "url": "https://mall.telunsu.net/telunsu/himilk/vip/vipCommunity.html"
                        },
                        {
                            "type": "view",
                            "name": "专属云「牧场」",
                            "url": "https://mc.telunsu.net/grazing/indexMc"
                        }
                    ]
                },
                {
                    "name": "名仕中心",
                    "sub_button":  [
                        {
                            "type": "view",
                            "name": "个人中心",
                            "url": "https://mall.telunsu.net/telunsu/himilk/user/index.html"
                        },
                        {
                            "type": "view",
                            "name": "我要提货",
                            "url": "https://mall.telunsu.net/telunsu/himilk/user/getGoods.html"
                        },
                        {
                            "type": "click",
                            "name": "客服中心",
                            "key": "help_center"
                        }
                    ]
                    
                }
            ]
        }';
        */
        $menus = '{
            "button": [
                {
                    "name": "官方商城",
                    "type": "view",
                    "url": "https://mall.telunsu.net/telunsu/himilk/product/index.html?vcome=wxmenu"
                },
                {
                    "name": "会员社区",
                    "sub_button": [
                        {
                            "type": "view",
                            "name": "会员社区",
                            "url": "https://mall.telunsu.net/telunsu/himilk/vip/vipCommunity.html"
                        },
                        {
                            "type": "miniprogram",
                            "name": "专属云「牧场」",
                            "url": "https://mc.telunsu.net/grazing/indexMc",
                            "appid": "wx267a967e4f2a33f9",
                            "pagepath": "pages/index/index?scene=xwMenu"
                        }
                    ]
                },
                {
                    "name": "名仕中心",
                    "sub_button": [
                        {
                            "type": "view",
                            "name": "个人中心",
                            "url": "https://mall.telunsu.net/telunsu/himilk/user/index.html"
                        },
                        {
                            "type": "view",
                            "name": "我要提货",
                            "url": "https://mall.telunsu.net/telunsu/himilk/user/getGoods.html"
                        },
                        {
                            "type": "click",
                            "name": "客服中心",
                            "key": "help_center"
                        }
                    ]
                }
            ]
        }';
        $menus = \yii\helpers\Json::decode($menus);
        // var_dump($menus);die;
        //$this->getServer()->setAccessToken('44_Mo7Echg9ml4GwU3Zc_5z-TUa4oy__cIcLg5of3oku3LYaQS5FYyTYDD2oU8ZBGdwrr6-VdLSCHwhfbIJalGfW0FSl8PuaXpAtMuIhR7PfPMAig4WTgnuEKaNsHiPyibKFmBDw-YAz4wEg2GNIOCfAJAXDR');
        $result = $this->getServer()->menu()->create($menus);
        if($result->isOk()) {
            return '操作成功!';
        }
        return '操作失败, [' . $result->code . ']' . $result->message;
    }



    /**
     * 获取公众号接口
     *
     * @return \wxapi\pub\Server
     */
    public function getServer()
    {
        return Yii::$app->wxpub;
    }
}
