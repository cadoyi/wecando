<?php

namespace wxapi\pub\oauth2;

use wxapi\pub\base\Component;


/**
 * 刷新 access token 
 *    access_token 有效期很短, refresh_token 的有效期为 30 天
 *    在 30 天内, 可以使用 refresh_token 刷新 access_token
 *    如果 refresh_token 过期, 则需要用户重新授权才可以.
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class RefreshToken extends Component
{
    const URL_PATH = '/sns/oauth2/refresh_token';

    /**
     * @var string 公众号 appid
     */
    public $appid;


    /**
     * @var string 授权类型
     */
    public $grant_type = 'refresh_token';


    /**
     * @var string 刷新 token 的值
     */
    public $refresh_token;



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if (!isset($this->appid)) {
            $this->appid = $this->config->appid;
        }
    }



    /**
     * 执行刷新操作
     *
     * @return \wxapi\pub\base\Result
     * { 
     *     "access_token":"ACCESS_TOKEN",
     *     "expires_in":7200,
     *     "refresh_token":"REFRESH_TOKEN",
     *     "openid":"OPENID",
     *     "scope":"SCOPE"  
     *  }
     */
    public function run()
    {
        $url = $this->buildUrl([
            'appid'         => $this->appid,
            'grant_type'    => $this->grant_type,
            'refresh_token' => $this->refresh_token,
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
