<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 文本消息接口
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Image extends Base
{
    /**
     * @var string  消息类型
     */
    public $msgtype = 'image';


    /**
     * 发送图片消息
     *
     * @param string $mediaID  图片的媒体 ID 值
     * @return bool
     */
    public function run( $mediaID )
    {
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'image' => [
                'media_id' => $mediaID,
            ],
        ];
        $this->sendMessage($content);
        return !$this->hasError();
    }
    
}