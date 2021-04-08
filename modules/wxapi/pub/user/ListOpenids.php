<?php

namespace wxapi\pub\user;

use Yii;
use wxapi\pub\base\Component;


/**
 * 列出公众号下的所有用户列表, 每次请求最多拉取 1万个 openid
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/Getting_a_User_List.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class ListOpenids extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/user/get';


    /**
     * @var string 下一个 openid
     */
    public $next_openid;



    /**
     * 查询 openid 
     *
     * @return \wxapi\pub\httpclient\Data
     *    [
     *        "total" => 'xxx',       //公众号总用户数
     *        "count" => 'xxx',       // 本次拉取的个数
     *        "data" => [           
     *            "openid" => [ .... ],
     *        ],
     *        "next_openid" => 'xxx',   // 本次拉取的最后一个 openid
     *    ]
     */
    public function run()
    {
        if(is_null($this->next_openid)) {
            $url = $this->buildUrl();
        } else {
            $url = $this->buildUrl(['next_openid' => $this->next_openid]);
        }
        
        $this->createRequest()
             ->setUrl($url)
             ->setMethod('GET')
             ->send();
        
        return $this->getData();
    }

}