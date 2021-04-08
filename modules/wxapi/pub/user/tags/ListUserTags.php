<?php

namespace wxapi\pub\user\tags;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;


/**
 * 列出某个用户的所有标签
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class ListUserTags extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/tags/getidlist';



    /**
     * 获取用户的标签列表
     *
     * @return \wxapi\pub\httpclient\Data
     *    [
     *       'tagid_list' => [ ... ],
     *    ]
     */
    public function run( $openid )
    {
        $url = $this->buildUrl();

        $content = Json::encode(['openid' => $openid]);

        $this->createRequest()
             ->setUrl($url)
             ->setMethod('POST')
             ->setContent($content)
             ->send();
        
        return $this->getData();
    }


}