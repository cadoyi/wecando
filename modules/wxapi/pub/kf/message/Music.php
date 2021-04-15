<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 音乐消息接口
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Music extends Base
{
    /**
     * @var string  消息类型
     */
    public $msgtype = 'music';



    /**
     * 发送音乐消息
     *
     * @param string $mediaID  音乐的媒体 ID 值
     * @param array $meta
     *     title
     *     description
     *     musicurl
     *     hqmusicurl
     *     thumb_media_id
     * @return \wxapi\pub\base\Result
     */
    public function run($mediaID, $meta = [])
    {
        $music = array_merge($meta, [
            'thumb_media_id' => $mediaID,
        ]);
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'music' => $music,
        ];
        $this->sendMessage($content);
        return $this->result;
    }

}
