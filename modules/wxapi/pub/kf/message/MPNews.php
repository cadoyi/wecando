<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 图文消息接口, 内部媒体 ID 方式
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MPNews extends Base
{
    /**
     * @var string  消息类型
     */
    public $msgtype = 'mpnews';


    /**
     * 发送图文消息, 最多只能发送一条图文消息
     * 
     * @param string $mediaID 
     * 
     * @return \wxapi\pub\base\Result
     */
    public function run( $mediaID )
    {
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'mpnews' => [
               'media_id' => $mediaID,
            ],
        ];
        $this->sendMessage($content);
        return $this->result;
    }


    
}
