<?php

namespace wxapi\pub\user;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;

/**
 * 修改用户的备注名称
 *
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/Configuring_user_notes.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class UpdateRemark extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/user/info/updateremark';



    /**
     * 修改备注名
     *
     * @param string $openid   用户的 openid
     * @param string $name   备注名
     * @return \wxapi\pub\base\Result
     */
    public function run( $openid,  $name )
    {
        $url = $this->buildUrl();

        $content = Json::encode([
            'openid' => $openid,
            'remark' => $name,
        ]);


        $this->createRequest()
             ->setUrl($url)
             ->setMethod('POST')
             ->setContent($content)
             ->send();

        return $this->result;
    }


}