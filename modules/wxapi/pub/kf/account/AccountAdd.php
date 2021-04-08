<?php

namespace wxapi\pub\kf\account;

use Yii;
use yii\helpers\Json;
use wxapi\pub\kf\Api;


/**
 * 添加客服账号, 每个公众号最多添加 100 个客服账号
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AccountAdd extends Api
{
    /**
     * URL 路径
     */
    const URL_PATH = '/customservice/kfaccount/add';


    

    /**
     * 添加客服账号
     *
     * @return bool
     */
    public function run($account, $nickname, $password)
    {
        $content = Json::encode([
            'kf_account' => $account,
            'nickname'   => $nickname,
            'password'   => $password,
        ]);

        $url = $this->buildUrl();

        $this->createRequest()
             ->setUrl($url)
             ->setMethod('POST')
             ->setContent($content)
             ->send();
        return !$this->hasError();
    }


}