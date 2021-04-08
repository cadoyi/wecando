<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 文本视频接口
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Video extends Base
{
    /**
     * @var string  消息类型
     */
    public $msgtype = 'video';


    /**
     * 发送视频消息
     *
     * @param string $mediaID  视频的媒体 ID 值
     * @param array $meta  元数据
     *     thumb_media_id
     *     title
     *     description
     * @return bool
     */
    public function run($mediaID, $meta = [])
    {
        $video = array_merge($meta, [
            'media_id' => $mediaID,
        ]);
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'video' => $video,
        ];
        $this->sendMessage($content);
        return !$this->hasError();
    }
}
