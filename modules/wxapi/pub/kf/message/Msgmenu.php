<?php

namespace wxapi\pub\kf\message;

use Yii;



/**
 * 发送菜单消息, 菜单消息可以被点击
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Msgmenu extends Base
{


    /**
     * 
     * @var string  消息类型
     */
    public $msgtype = 'msgmenu';


    /**
     * 发送图文消息, 最多只能发送一条图文消息
     * 
     * {
     *     "touser": "OPENID",
     *     "msgtype": "msgmenu",
     *     "msgmenu": {
     *          "head_content": "您对本次服务是否满意呢? "
     *          "list": [
     *               {
     *                   "id": "101",
     *                   "content": "满意"
     *               },
     *               {
     *                    "id": "102",
     *                    "content": "不满意"
     *               }
     *          ],
     *          "tail_content": "欢迎再次光临"
     *     }
     * }
     * 
     * 当点击满意的时候, 微信就会推送一个 text 消息
     * <xml>
     *     <ToUserName><![CDATA[ToUser]]></ToUserName>
     *     <FromUserName><![CDATA[FromUser]]></FromUserName>
     *     <CreateTime>1500000000</CreateTime>
     *     <MsgType><![CDATA[text]]></MsgType>
     *     <Content><![CDATA[满意]]></Content>
     *     <MsgId>1234567890123456</MsgId>
     *     <bizmsgmenuid>101</bizmsgmenuid>
     * </xml>
     *   content 为点击的菜单名
     *   bizmsgmenuid 为点击的菜单 ID
     * 
     * 
     * @param string $header 顶部内容
     * @param array  $list   列表内容
     * @param string $footer 底部内容
     * 
     * @return \wxapi\pub\base\Result
     */
    public function run($header, $list, $footer)
    {
        $content = [
            'touser' => $this->touser,
            'msgtype' => $this->msgtype,
            'msgmenu' => [
                'head_content' => $header,
                'list'         => $list,
                'tail_content' => $footer,
            ],
        ];
        $this->sendMessage($content);
        return $this->result;
    }
}
