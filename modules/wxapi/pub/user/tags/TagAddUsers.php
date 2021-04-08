<?php

namespace wxapi\pub\user\tags;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;

/**
 * 批量将用户加入某个标签
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TagAddUsers extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/tags/members/batchtagging';



    /**
     * 批量为用户打标签
     *
     * @param int $tagID  标签的 ID
     * @param string|array $openids  
     * @return bool
     */
    public function run($tagID, $openids)
    {
        $url = $this->buildUrl();
        if(is_string($openids)) {
            $openids = [ $openids ];
        } else {
            $openids = array_values($openids);
        }
        $content = Json::encode([
            'tagid' => $tagID,
            'openid_list' => $openids,
        ]);

        $this->createRequest()
             ->setMethod('POST')
             ->setContent($content)
             ->setUrl($url)
             ->send();

        return $this->hasError();
    }


}