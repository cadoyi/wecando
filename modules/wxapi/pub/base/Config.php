<?php

namespace wxapi\pub\base;

use Yii;
use yii\base\BaseObject;


/**
 * 微信配置类
 * 
 * @property string $appid
 * @property string $appsecret
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Config extends BaseObject
{
     
    /**
     * @var string 微信的 APP ID 参数
     */
    public $app_id;


    /**
     * @var string 微信的 APP Secret 参数
     */
    public $app_secret;


    /**
     * @var string 微信公众号后台填写的验证 token
     */
    public $token;




    /**
     * 获取 appid
     *
     * @return string      
     */
    public function getAppid()
    {
        return $this->app_id;
    }



    /**
     * 设置 appid
     *
     * @param string $appid
     * @return void
     */
    public function setAppid( $appid )
    {
        $this->app_id = $appid;
    }




    /**
     * 获取 app secret
     *
     * @return string
     */
    public function getAppSecret()
    {
        return $this->app_secret;
    }



    /**
     * 设置 app secret
     *
     * @param string $secret
     * @return void
     */
    public function setAppSecret( $secret )
    {
        $this->app_secret = $secret;
    }




}