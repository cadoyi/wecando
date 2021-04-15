<?php

namespace wxapi\pub\user\tags;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;


/**
 * 获取某个标签下的用户列表
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TagUserList extends Component
{

    /**
     * URL 列表
     */
    const URL_PATH = '/cgi-bin/user/tag/get';



    /**
     * 获取列表
     *
     * @param string $tagID 标签 ID
     * @param string|null 上一次返回的 next_openid, 如果第一次拉取,则填 null
     * 
     * @return \wxapi\pub\base\Result
     *    [
     *         'count' => 2,    // 本次获取的粉丝数量
     *         'data' => [
     *             'openid' => [
     *                  // openid1,
     *                  // openid2,
     *                   ...
     *             ],
     *         ],
     *         'next_openid' => 'xxxx',   //本次拉取列表最后一个用户的openid 
     *    ]
     */
    public function run($tagID, $nextOpenid = null)
    {
        $url = $this->buildUrl();
        $content = ['tagid' => $tagID];
        if(!is_null($nextOpenid)) {
            $content['next_openid'] = $nextOpenid;
        }
        $content = Json::encode($content);

        $this->createRequest()
            ->setMethod('POST')
            ->setUrl($url)
            ->setContent($content)
            ->send();
        
        return $this->result;
    }

    

}