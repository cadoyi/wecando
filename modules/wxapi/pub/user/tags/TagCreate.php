<?php

namespace wxapi\pub\user\tags;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;

/**
 * 创建标签, 一个公众号最多可以创建 100 个标签
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TagCreate extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/tags/create';




    /**
     * 执行创建标签操作
     *
     * @param string $name 标签名称
     * @return \wxapi\pub\httpclient\Data
     *     {   "tag":{ "id":134,//标签id "name":"广东"   } } 
     */
    public function run( $name )
    {
        $url = $this->buildUrl();

        $content = Json::encode(['tag' => ['name' => $name]]);
        $this->createRequest()
             ->setMethod('POST')
             ->setUrl($url)
             ->setContent($content)
             ->send();
        
        return $this->getData();
    }

}