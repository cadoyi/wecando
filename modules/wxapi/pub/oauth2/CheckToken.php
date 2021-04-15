<?php

namespace wxapi\pub\oauth2;

use Yii;
use wxapi\pub\base\Component;


/**
 * 检查 access token 是否仍然有效
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class CheckToken extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/sns/auth';


    /**
     * @var string 用户的 access_token, 和基础支持的 access_token 不一致
     */
    public $access_token;



    /**
     * @var string 用户的 openid
     */
    public $openid;




    /**
     * 执行操作
     *
     * @return \wxapi\pub\base\Result
     *  
     * 成功返回:
     *     { "errcode":0,"errmsg":"ok"}
     * 失败返回:
     *     { "errcode":40003,"errmsg":"invalid openid"}
     * 
     */
    public function run()
    {
        $url = $this->buildUrl([
            'access_token' => $this->access_token,
            'openid'       => $this->openid,
        ]);

        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();
        return $this->result;
    }
    



}