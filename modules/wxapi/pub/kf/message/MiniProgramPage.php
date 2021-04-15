<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 发送小程序卡片
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MiniProgramPage extends Base
{


    /** 
     * @var string  消息类型
     */
    public $msgtype = 'miniprogrampage';





    /**
     * 发送小程序卡片
     *
     * @param array $meta 
     *     appid
     *     title
     *     pagepath
     *     thumb_media_id
     * @return \wxapi\pub\base\Result
     */
    public function run($meta = [])
    {
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'miniprogrampage' => $meta,
        ];
        
        $this->sendMessage($content);
        return $this->result;
    }




}
