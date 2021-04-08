<?php

namespace wxapi\pub\oauth2;

use Yii;
use yii\helpers\Url;
use wxapi\pub\base\Component;


/**
 * 授权
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Authorize extends Component
{


    /**
     * 授权 URL 
     */
    const AUTH_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize';

    /**
     * URL 后面的 fragment 参数
     */
    const FRAGMENT = '#wechat_redirect';


    /**
     * 静默授权 不弹出授权页面，直接跳转，只能获取用户openid
     */
    const SCOPE_BASE = 'snsapi_base';

    /**
     * 弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息
     */
    const SCOPE_USERINFO = 'snsapi_userinfo';



    /**
     * @var string 授权方式, 默认静默授权
     */
    public $scope = self::SCOPE_BASE;


    /**
     * @var string 响应类型
     */
    public $response_type = 'code';


    /**
     * @var string 状态串, 用于验证
     */
    public $state;


    /**
     * @var string 回调 URL, 授权后重定向的回调链接地址， 请使用 urlEncode 对链接进行处理.
     */
    public $redirect_uri;


    /**
     * @var string  appid 参数
     */
    public $appid;



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if(!isset($this->appid)) {
            $this->appid = $this->config->appid;
        }
        if(!isset($this->redirect_uri)) {
            $this->redirect_uri = Url::current(['code' => null, 'state' => null], true);
        }
    }

    /**
     * 调用授权
     *
     * @return void
     */
    public function run()
    {
        $url = self::AUTH_URL;

        // 据说顺序很重要,所以不要改动顺序
        $params = [
            'appid'         => $this->appid,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => $this->response_type,
            'scope'         => $this->scope,
        ];
        if(isset($this->state)) {
            $params['state'] = $this->state;
        }
        $url .= '?' . http_build_query($params) . self::FRAGMENT;

        return $this->server->redirect($url);
    }

    
}