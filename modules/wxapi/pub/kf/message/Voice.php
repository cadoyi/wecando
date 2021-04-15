<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 发送语音消息
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Voice extends Base
{
    /**
     * @var string  消息类型
     */
    public $msgtype = 'voice';


    /**
     * 发送语音消息
     *
     * @param string $mediaID 语音的媒体 ID
     * @return \wxapi\pub\base\Result
     */
    public function run($mediaID)
    {
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'voice' => [
                'media_id' => $mediaID,
            ],
        ];
        $this->sendMessage($content);
        return $this->result;
    }
}
