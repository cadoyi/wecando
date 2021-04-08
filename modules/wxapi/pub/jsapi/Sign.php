<?php

namespace wxapi\pub\jsapi;

use Yii;
use yii\helpers\Url;
use wxapi\pub\httpclient\Data;
use wxapi\pub\base\Component;

/**
 *  jsapi 签名工具
 * 
 * @link https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html#62
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Sign extends Component
{

    /**
     * @var string 要分享的 APP ID
     */
    public $appid;

    /**
     * @var string 随机字符串
     */
    public $noncestr;


    /**
     * @var string  jsapi 调用凭据
     */
    public $jsapi_ticket;


    /**
     * @var int 当时时间戳
     */
    public $timestamp;


    /**
     * @var string 要进行分享的 URL
     */
    public $url;



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        if(!$this->url) {
            $this->url = Url::current([], true);
        }
        if(!$this->timestamp) {
            $this->timestamp = time();
        }

        if(!$this->noncestr) {
            $this->noncestr = Yii::$app->security->generateRandomString();
        }

        if(!isset($this->appid)) {
            $this->appid = $this->config->getAppid();
        }
    }


    /**
     * 进行签名
     *
     * @return void
     */
    public function run()
    {
        $params = [
            'jsapi_ticket' => $this->jsapi_ticket,
            'noncestr'     => $this->noncestr,
            'timestamp'    => $this->timestamp,
            'url'          => $this->url,
        ];
        
        $string = '';
        foreach($params as $k => $v) {
            $string .= $k . '=' . $v . '&';
        }
        $string = rtrim($string, '&');
         
        $sign = sha1($string);

        $data = [
            "appid"    => $this->appid,
            "nonceStr" => $this->noncestr,
            "timestamp" => $this->timestamp,
            "url"       => $this->url,
            "signature" => $sign,
        ];

        return new Data([
            'data' => $data,
        ]);
    }

}