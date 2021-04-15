<?php

namespace wxapi\pub\user\tags;


use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;


/**
 * 批量从标签中移除用户
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TagRemoveUsers extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/tags/members/batchuntagging';



    /**
     * 批量从标签中移除用户
     *
     * @return \wxapi\pub\base\Result
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
            ->setUrl($url)
            ->setMethod('POST')
            ->setContent($content)
            ->send();

        return $this->result;
    }

}