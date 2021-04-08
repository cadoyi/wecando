<?php

namespace wxapi\pub\media;

use Yii;


/**
 * 添加临时媒体接口, 有效期为 3 天.
 * 
 * 图片（image）: 10M，支持PNG\JPEG\JPG\GIF格式
 * 语音（voice）：2M，播放长度不超过60s，支持AMR\MP3格式
 * 视频（video）：10MB，支持MP4格式
 * 缩略图（thumb）：64KB，支持JPG格式
 * 
 * @link https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/New_temporary_materials.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Upload extends Api
{

    /**
     * URL 路径
     */
    const URL_PATH = 'cgi-bin/media/upload';


    /**
     * 文件类型为图片
     */
    const TYPE_IMAGE = 'image';

    /**
     * 文件类型为语音
     */
    const TYPE_VOICE = 'voice';

    /**
     * 文件类型为视频
     */
    const TYPE_VIDEO = 'video';

    /**
     * 文件类型为缩略图
     */
    const TYPE_THUMB = 'thumb';


    /**
     * @var string 增加媒体文件的类型   
     */
    public $type = self::TYPE_IMAGE;


    /**
     * @var string 需要上传的媒体文件
     */
    public $media;




    /**
     * 执行上传操作
     *
     * @return \wxapi\pub\httpclient\Data
     *  {
     *      "type": "TYPE",
     *      "media_id": <MEDIA_ID>,
     *      "created_at": <CREATED_AT>
     *  }
     */
    public function run()
    {
        $url = $this->buildUrl([
            'type' => $this->type,
        ]);
        $this->createRequest()
             ->setUrl($url)
             ->setMethod('POST')
             ->addFile('media', $this->file)
             ->send();
        return $this->getData();
    }




}