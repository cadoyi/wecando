<?php

namespace wxapi\pub\token;

use Yii;
use wxapi\pub\base\Component;


/**
 * 获取基础支持 access token, 要和用户的 access_token区分开
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TokenServer extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/token';
    
    /**
     * @var string 公众号的 appid
     */
    public $appid;


    /**
     * @var string 公众号的 app secret
     */
    public $secret;



    /**
     * @var string  授权类型
     */
    public $grant_type = 'client_credential';



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if(!$this->appid) {
            $this->appid = $this->config->appid;
        }
        if(!$this->secret) {
            $this->secret = $this->config->app_secret;
        }
    }

   
    /**
     * 执行
     *
     * @return \wxapi\pub\base\Result
     *     access_token
     *     expires_in
     */
    public function run()
    {
        $url = $this->buildUrl([
            'appid' => $this->appid,
            'secret' => $this->secret,
            'grant_type' => $this->grant_type,
        ]);

        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();

        return $this->getResult();
    }



}
