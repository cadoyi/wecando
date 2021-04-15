<?php

namespace wxapi\pub\oauth2;

use Yii;
use wxapi\pub\base\Component;

/**
 * 当授权为 snsapi_userinfo 的时候调用这个接口可以获取用户的基本信息
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Userinfo extends Component
{

    /**
     * API URL 路径
     */
    const URL_PATH = '/sns/userinfo';


    /**
     * @var string 这里是授权码换取的 token, 和基础支持的 access_token 不一样
     */
    public $access_token;


    /**
     * @var string 用户的 openid
     */
    public $openid;


    /**
     * @var string 返回的国家和地区部分使用的语言
     */
    public $lang = 'zh_CN';




    /**
     * 获取用户信息
     *
     * @return \wxapi\pub\base\Result
     * {   
     *     "openid": "OPENID",
     *     "nickname": NICKNAME,
     *     "sex": 1,
     *     "province":"PROVINCE",
     *     "city":"CITY",
     *     "country":"COUNTRY",
     *     "headimgurl":"https://thirdwx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46",
     *     "privilege":[ "PRIVILEGE1" "PRIVILEGE2"     ],
     *     "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
     * }
     */
    public function run()
    {
        $url = $this->getUrl([
            'access_token' => $this->access_token,
            'openid'       => $this->openid,
            'lang'         => $this->lang,
        ]);

        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();

        return $this->result;
    }

    
}
