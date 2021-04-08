<?php

namespace wxapi\pub\message;

use Yii;
use wxapi\pub\base\Api as BaseApi;

/**
 * 用户可以给公众号发送消息 公众号会推送一个 XML 数据包到后台,后台可以做出相应的处理
 * 
 * 当后台没有处理消息的时候,微信会进行重试, 总共重试三次, 建议使用 MsgId 参数区分是否为重试请求.
 * 
 * 1.文本消息结构:
 * <xml>
 *     <ToUserName><![CDATA[toUser]]></ToUserName>
 *     <FromUserName><![CDATA[fromUser]]></FromUserName>
 *     <CreateTime>1348831860</CreateTime>
 *     <MsgType><![CDATA[text]]></MsgType>
 *     <Content><![CDATA[this is a test]]></Content>
 *     <MsgId>1234567890123456</MsgId>
 * </xml>
 *
 * 2.图片消息结构
 * <xml>
 *     <ToUserName><![CDATA[toUser]]></ToUserName>
 *     <FromUserName><![CDATA[fromUser]]></FromUserName>
 *     <CreateTime>1348831860</CreateTime>
 *     <MsgType><![CDATA[image]]></MsgType>
 *     <PicUrl><![CDATA[this is a url]]></PicUrl>
 *     <MediaId><![CDATA[media_id]]></MediaId>
 *     <MsgId>1234567890123456</MsgId> 
 * </xml>
 * 
 * 3.语音消息结构
 * <xml>
 *     <ToUserName><![CDATA[toUser]]></ToUserName>
 *     <FromUserName><![CDATA[fromUser]]></FromUserName>
 *     <CreateTime>1357290913</CreateTime>
 *     <MsgType><![CDATA[voice]]></MsgType>
 *     <MediaId><![CDATA[media_id]]></MediaId>
 *     <Format><![CDATA[Format]]></Format>
 *     <Recognition>< ![CDATA[腾讯微信团队] ]></Recognition>
 *     <MsgId>1234567890123456</MsgId>
 * </xml>
 * 
 *  需要注意: 开启语音识别后, 才会有 Recognition 字段
 * 
 * 4. 视频消息
 * <xml>
 *     <ToUserName><![CDATA[toUser]]></ToUserName>
 *     <FromUserName><![CDATA[fromUser]]></FromUserName>
 *     <CreateTime>1357290913</CreateTime>
 *     <MsgType><![CDATA[video]]></MsgType>
 *     <MediaId><![CDATA[media_id]]></MediaId>
 *     <ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
 *     <MsgId>1234567890123456</MsgId>
 * </xml>
 *
 * 5. 小视频消息
 * <xml>
 *     <ToUserName><![CDATA[toUser]]></ToUserName>
 *     <FromUserName><![CDATA[fromUser]]></FromUserName>
 *     <CreateTime>1357290913</CreateTime>
 *     <MsgType><![CDATA[shortvideo]]></MsgType>
 *     <MediaId><![CDATA[media_id]]></MediaId>
 *     <ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
 *     <MsgId>1234567890123456</MsgId>
 * </xml>
 * 
 * 
 * 6. 地理位置信息
 * <xml>
 *     <ToUserName><![CDATA[toUser]]></ToUserName>
 *     <FromUserName><![CDATA[fromUser]]></FromUserName>
 *     <CreateTime>1351776360</CreateTime>
 *     <MsgType><![CDATA[location]]></MsgType>
 *     <Location_X>23.134521</Location_X>
 *     <Location_Y>113.358803</Location_Y>
 *     <Scale>20</Scale>
 *     <Label><![CDATA[位置信息]]></Label>
 *     <MsgId>1234567890123456</MsgId>
 * </xml>
 * 
 * 7. 链接消息
 * <xml>
 *     <ToUserName><![CDATA[toUser]]></ToUserName>
 *     <FromUserName><![CDATA[fromUser]]></FromUserName>
 *     <CreateTime>1351776360</CreateTime>
 *     <MsgType><![CDATA[link]]></MsgType>
 *     <Title><![CDATA[公众平台官网链接]]></Title>
 *     <Description><![CDATA[公众平台官网链接]]></Description>
 *     <Url><![CDATA[url]]></Url>
 *     <MsgId>1234567890123456</MsgId> 
 * </xml>
 * 
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Api extends BaseApi
{

    
    /**
     * 获取 request 对象
     *
     * @return \wxapi\pub\base\XmlRequest
     */
    public function getRequest()
    {
        return $this->server->getRequest();
    }


    /**
     * 返回一个成功收到消息的通知,后续才会异步发送响应内容.
     * 假如服务器无法保证在五秒内处理并回复，必须做出下述回复，这样微信服务器才不会对此作任何处理，
     * 并且不会发起重试（这种情况下，可以使用客服消息接口进行异步回复），否则，将出现严重的错误提示。
     * 
     * @return void
     */
    public function replyAccepted()
    {
        return $this->server->sendRaw('success');
    }




    /**
     * 回复文本消息
     *
     * @return void
     */
    public function replyText( $text )
    {
        $xml = [
            'ToUserName'   => $this->getRequest()->get('FromUserName'),
            'FromUserName' => $this->getRequest()->get('ToUserName'),
            'CreateTime'   => time(),
            'MsgType'      => 'text',
            'Content'      => $text,
        ];
        return $this->server->sendXml($xml);
    }


    /**
     * 回复图片消息
     *
     * @return void
     */
    public function replyImage($mediaID)
    {
        $xml = [
            'ToUserName'   => $this->getRequest()->get('FromUserName'),
            'FromUserName' => $this->getRequest()->get('ToUserName'),
            'CreateTime'   => time(),
            'MsgType'      => 'image',
            'Image'        => [
                'MediaId'  => $mediaID,
            ],
        ];
        return $this->server->sendXml($xml);
    }


    /**
     * 回复语音消息
     *
     * @return void
     */
    public function replyVoice($mediaID)
    {
        $xml = [
            'ToUserName'   => $this->getRequest()->get('FromUserName'),
            'FromUserName' => $this->getRequest()->get('ToUserName'),
            'CreateTime'   => time(),
            'MsgType'      => 'voice',
            'Voice'        => [
                'MediaId'  => $mediaID,
            ],
        ];
        return $this->server->sendXml($xml);
    }


    /**
     * 回复视频消息
     *
     * @param string $mediaID 视频的媒体 ID
     * @param string $title  视频标题
     * @param array $meta
     *     Title: 视频标题
     *     Description: 视频描述
     * @return void
     */
    public function replyVideo($mediaID, $meta = [])
    {
        $video = array_merge($meta, [
            'MediaId'     => $mediaID,
        ]);
        $xml = [
            'ToUserName'   => $this->getRequest()->get('FromUserName'),
            'FromUserName' => $this->getRequest()->get('ToUserName'),
            'CreateTime'   => time(),
            'MsgType'      => 'video',
            'Video'        => $video,
        ];
        return $this->server->sendXml($xml);

    }



    /**
     * 回复音乐消息
     *
     * @param string $mediaID
     * @param array $meta 
     *     Title: 音乐标题
     *     Description: 音乐描述
     *     MusicURL:  音乐链接
     *     HQMusicUrl: 高质量音乐链接, WIFI 环境优先播放此链接音乐
     * @return void
     */
    public function replyMusic($mediaID, $meta = [])
    {
        $music = array_merge($meta, [
            'ThumbMediaId' => $mediaID,
        ]);
        $xml = [
            'ToUserName'   => $this->getRequest()->get('FromUserName'),
            'FromUserName' => $this->getRequest()->get('ToUserName'),
            'CreateTime'   => time(),
            'MsgType'      => 'music',
            'Music'        => $music,
        ];
        return $this->server->sendXml($xml);
    }



    /**
     * 回复图文消息
     *
     * @param array $articles 
     *     二位数组,每个数组元素都有如下信息, 每个元素都必须使用 item 标签
     *       Title:   图文消息标题
     *       Description: 图文消息描述
     *       PicUrl: 图片链接,支持 JPG, PNG 格式,大图 360*200,小图 200*200
     *       Url: 点击图文消息跳转的链接
     * 
     * @return void
     */
    public function replyArticle(array $articles)
    {
        $xml = [
            'ToUserName'   => $this->getRequest()->get('FromUserName'),
            'FromUserName' => $this->getRequest()->get('ToUserName'),
            'CreateTime'   => time(),
            'MsgType'      => 'news',
            'ArticleCount' => count($articles),
            'Articles'     => $articles,
        ];
        return $this->server->sendXml($xml);
    }



    
}
