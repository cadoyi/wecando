<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 图文消息接口, 跳转到外链
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class News extends Base
{
    /**
     * @var string  消息类型
     */
    public $msgtype = 'news';


    /**
     * 发送图文消息, 最多只能发送一条图文消息
     * 
     * @param array $article
     *     title
     *     description
     *     url
     *     picurl
     * 
     * @return bool
     */
    public function run( $article = [])
    {
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'news' => [
                'articles' => [
                    $article,
                ],
            ],
        ];
        $this->sendMessage($content);
        return !$this->hasError();
    }


}