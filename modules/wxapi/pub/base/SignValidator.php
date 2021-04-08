<?php


namespace wxapi\pub\base;

use Yii;
use yii\helpers\Json;

/**
 * 验证是否是微信返回的信息
 * 
 * @property Config $config  
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class SignValidator extends \yii\base\Component
{

    /**
     * @var wxapi\pub\base\Component 
     */
    public $server;



    /**
     * 获取配置类
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->server->getConfig();
    }



    /**
     * 获取 GET 参数
     *
     * @param string $name  参数名
     * @param mixed $defaultValue  默认值
     * @return mixed
     */
    public function getParam($name, $defaultValue = '')
    {
        return isset($_GET[$name]) ? $_GET[$name] : $defaultValue;
    }



    /**
     * 验证请求的来源是否是微信服务器
     *
     * @return bool
     */
    public function isFromWechatServer()
    {
        $signature = $this->getParam('signature', '');
        $timestamp = $this->getParam('timestamp', '');
        $nonce     = $this->getParam('nonce', '');
        $token = $this->config->token;

        // 1. 将 token, timestamp, nonce 按照字段排序
        $arr = [ $token, $timestamp, $nonce ];
        sort($arr, \SORT_STRING);

        // 2. 将排序的参数拼接成字符串进行 sha1 加密
        $param = implode("", $arr);
        $sign  = sha1($param);
        
        // 3. 检查 signature 是否和计算的值一样
        return $sign == $signature;        
    }




    /**
     * 获取 echostr 
     *
     * @return string|false|null
     */
    public function getEchoStr()
    {
        if($this->isFromWechatServer()) {
            return $this->getParam('echostr', null);
        }
        return false;
    }



}