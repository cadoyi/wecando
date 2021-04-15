<?php

namespace wxapi\pub\user;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;

/**
 * 批量拉取用户的基本信息
 * 
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/Get_users_basic_information_UnionID.html#UinonId
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class BatchInfo extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/user/info/batchget';


    /**
     * 批量获取用户基本信息, 取消关注的只返回 openid 和 subscribe 为 0 
     *  
     * 只有在 subscribe 为 1 的情况下, 才会返回更详细的信息.
     *
     * @param string|array $openids  最多支持 100 条 openid
     * @param string $lang  返回的信息使用的语言版本
     * 
     * @return \wxapi\pub\base\Result
     * 
     * 
     */
    public function run( $openids, $lang = 'zh_CN')
    {
        $url = $this->buildUrl();

        if(is_string($openids)) {
            $openids = [ $openids ];
        } else {
            $openids = array_values($openids);
        }
        $list = [];
        foreach($openids as $openid) {
            $list[] = [
                'openid' => $openid,
                'lang'   => $lang,
            ];
        }

        $content = Json::encode(['user_list' => $list]);

        $this->createRequest()
             ->setUrl($url)
             ->setMethod('POST')
             ->setContent($content)
             ->send();

        return $this->result;
    }

}