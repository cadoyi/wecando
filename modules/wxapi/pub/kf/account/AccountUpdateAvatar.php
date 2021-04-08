<?php

namespace wxapi\pub\kf\account;

use Yii;
use wxapi\pub\kf\Api;

/**
 * 更新用户头像
 * 
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AccountUpdateAvatar extends Api
{

    /**
     * URL 路径
     */
    const URL_PATH = '/customservice/kfaccount/uploadheadimg';



    /**
     * @var string 客服账号
     */
    public $kf_account;


    /**
     * 上传头像
     *
     * @return bool
     */
    public function run($file)
    {
        $url = $this->buildUrl([
            'kf_account' => $this->kf_account,
        ]);

        if(strncmp($file, '@', 1) === 0) {
            $file = Yii::getAlias($file);
        }

        $this->createRequest()
             ->setMethod('POST')
             ->setUrl($url)
             ->addFile('headimg', $file)
             ->send();
        return !$this->hasError();
    }

    
}