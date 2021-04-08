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
        if(!Yii::$app->request->isPost && is_string($echostr)) {
            return $echostr;
        }
        if ($echostr === false) {
            return $this->notFound();
        }
        $request = $this->getServer()->getRequest();
        echo 'success';die;

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

        $result = $this->getServer()->menu()->create($menus);
        
        var_dump($result);
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
