<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 发送卡券
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Wxcard extends Base
{
    /**
     * @var string  消息类型
     */
    public $msgtype = 'wxcard';



    /**
     * 发送卡券
     *
     * @param string $cardID  卡券的 ID 值
     * @return \wxapi\pub\base\Result
     */
    public function run( $cardID )
    {
        $content = [
            'touser'  => $this->touser,
            'msgtype' => $this->msgtype,
            'wxcard'  => [
                'card_id' => $cardID,
            ],
        ];

        $this->sendMessage($content);
        return $this->result;
    }


}
