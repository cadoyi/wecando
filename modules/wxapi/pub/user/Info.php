<?php

namespace wxapi\pub\user;

use Yii;
use wxapi\pub\base\Component;

/**
 * 获取某个用户的详细信息
 * 
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/Get_users_basic_information_UnionID.html#UinonId
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Info extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/user/info';


    /**
     * @var string $openid  用户的 openid
     */
    public $openid;


    /**
     * @var string  获取到的地址等信息使用的语言
     */
    public $lang = 'zh_CN';



    /**
     * 获取用户的基本信息
     *
     * @return \wxapi\pub\base\Result
     */
    public function run()
    {

        $url = $this->buildUrl([
            'openid' => $this->openid,
            'lang'   => $this->lang,
        ]);

        $this->createRequest()
             ->setUrl($url)
             ->setMethod('GET')
             ->send();

        return $this->result;
    }

}