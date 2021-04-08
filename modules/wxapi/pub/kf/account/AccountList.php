<?php

namespace wxapi\pub\kf\account;

use Yii;
use wxapi\pub\kf\Api;


/**
 * 获取账号列表
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AccountList extends Api
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/customservice/getkflist';



    /**
     * 获取所有客服列表
     *
     * @return \wxapi\pub\httpclient\Data
     * 
     * {
     *      "kf_list": [
     *          {
     *               "kf_account": "test1@test", 
     *               "kf_nick": "ntest1", 
     *               "kf_id": "1001",
     *               "kf_headimgurl": " http://mmbiz.qpic.cn/mmbiz/4whpV1VZl2iccsvYbHvnphkyGtnvjfUS8Ym0GSaLic0FD3vN0V8PILcibEGb2fPfEOmw/0"
     *          }, 
     *          {
     *               "kf_account": "test2@test", 
     *               "kf_nick": "ntest2", 
     *               "kf_id": "1002",
     *              "kf_headimgurl": " http://mmbiz.qpic.cn/mmbiz/4whpV1VZl2iccsvYbHvnphkyGtnvjfUS8Ym0GSaLic0FD3vN0V8PILcibEGb2fPfEOmw /0"
     *          }
     *     ]
     *  } 
     * 
     * 
     */
    public function run()
    {

        $url = $this->buildUrl();

        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();
        
        return $this->getData();
    }


}