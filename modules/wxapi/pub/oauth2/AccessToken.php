<?php

namespace wxapi\pub\oauth2;

use Yii;
use wxapi\pub\base\Component;

/**
 * 获取特殊的网页授权 token
 * 
 * 特别注意:  
 *     这里获取到的 access_token 只能用于获取用户信息.
 *     当授权的 scope 为 snsapi_base 的时候, 需要使用这个参数来换取 openid
 * 
 *     一定要和基础支持中的 access_token 区分开!!!!!!    
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AccessToken extends Component
{

    /**
     *  URL 路径
     */
    const URL_PATH = '/sns/oauth2/access_token';

    /**
     * @var string 公众号的 appid
     */
    public $appid;


    /**
     * @var string 公众号的 app secret
     */
    public $secret;



    /**
     * @var string 基础授权返回的授权码,只能使用一次.
     */
    public $code;



    /**
     * @var string  授权类型
     */
    public $grant_type='authorization_code';



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if(!isset($this->appid)) {
            $this->appid = $this->config->appid;
        }
        if(!isset($this->secret)) {
            $this->secret = $this->config->appsecret;
        }

    }



    /**
     * 执行
     *
     * @return \wxapi\pub\base\Result
     *     access_token
     *     expires_in: 7200
     *     refresh_token:
     *     openid
     *     scope
     */
    public function run()
    {
        $url = $this->buildUrl([
            'appid'      => $this->appid,
            'secret'     => $this->secret,
            'code'       => $this->code,
            'grant_type' => $this->grant_type,
        ]);
        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();
        if($this->hasError()) {
            return false;
        }
        return $this->result;
    }


}