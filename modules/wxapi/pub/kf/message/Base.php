<?php

namespace wxapi\pub\kf\message;

use Yii;
use yii\helpers\Json;
use wxapi\pub\kf\Api;

/**
 * 客服消息基类
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Base extends Api
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/message/custom/send';

    /**
     * @var string 发送给某个 openid ,所以这里是 openid
     */
    public $touser;


    /**
     * @var string 消息类型
     */
    public $msgtype;


    /**
     * @var string 如果设置, 则使用这个客服账号发送消息
     */
    public $kf_account;




    /**
     * 发送消息
     *
     * @param array $content  消息内容
     * @return void
     */
    public function sendMessage( $content )
    {
        if(isset($this->kf_account)) {
            $content['customservice'] = [
                'kf_account' => $this->kf_account,
            ];
        }
        $content = Json::encode($content);
        $url = $this->buildUrl();
        $this->createRequest()
             ->setMethod('POST')
             ->setUrl($url)
             ->setContent($content)
             ->send();
    }

}
