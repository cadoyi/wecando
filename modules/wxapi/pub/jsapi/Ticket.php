<?php

namespace wxapi\pub\jsapi;

use Yii;
use wxapi\pub\base\Component;

/**
 * 获取调用 jssdk 的临时票据, 有效期为 7200 秒,调用次数有限,需要缓存起来
 * 
 * @link https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html#62
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Ticket extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/ticket/getticket';



    public $type = 'jsapi';


    /**
     * 获取票据, 每天的获取次数受限, 需要缓存起来使用
     *
     * @return \wxapi\pub\httpclient\Data
     * {
     *     "errcode": 0,
     *     "errmsg": "ok",
     *     "ticket": "bxLdikRXVbTPdHSM05e5u5sUoXNKd8-41ZO3MhKoyN5OfkWITDGgnr2fwJ0m9E8NYzWKVZvdVtaUgWvsdshFKA",
     *     "expires_in": 7200
     * }
     */
    public function run()
    {
        $url = $this->buildUrl([
            'type' => $this->type,
        ]);

        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();
        return $this->getData();
    }




}