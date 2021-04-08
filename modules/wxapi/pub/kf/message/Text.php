<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 文本消息接口
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Text extends Base
{

    /**
     * @var string  消息类型
     */
    public $msgtype = 'text';



    /**
     * 发送文本消息
     *
     * @param string $text
     * @return bool
     */
    public function run( $text )
    {
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'text' => [
                'content' => $text,
            ],
        ];

        $this->sendMessage($content);
        return !$this->hasError();
    }

}