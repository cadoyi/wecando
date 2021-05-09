<?php

namespace core\api;

use Yii;
use yii\di\Instance;
use yii\httpclient\Client;
use yii\httpclient\Request;
use yii\httpclient\Response;

/**
 * server 组件
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class BaseServer extends \yii\base\Component
{
    /**
     * @var string 请求之前的事件
     */
    const EVENT_BEFORE_REQUEST = 'beforeRequest';


    /**
     * @var string 请求之后的事件
     */
    const EVENT_AFTER_REQUEST = 'afterRequest';


    /**
     * @var string  api 响应结果类
     */
    public $responseClass = BaseResponse::class;


    /**
     * @var string API 接口的基本 URL
     */
    public $baseUrl;


    /**
     * @var BaseConfig
     */
    protected $_config;



    /**
     * @var string|array|Client  客户端组件
     */
    protected $_httpclient = 'httpclient';




    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        $this->_httpclient = Instance::ensure($this->_httpclient);
    }




    /**
     * 设置配置
     *
     * @param array $config
     * @return void
     */
    public function setConfig( array $config = [] )
    {
        $this->_config = Yii::createObject($config);
    }



    /**
     * 获取配置组件
     *
     * @return BaseConfig
     */
    public function getConfig()
    {
        return $this->_config;
    }




    /**
     * 创建 API 组件实例
     *
     * @param string|array $config 组件类名或者组件配置
     * @return Component
     */
    public function createObject($config)
    {
        if(is_string($config)) {
            $config = ['class' => $config];
        }
        $config = array_merge($config, [
            'server' => $this,
            'config' => $this->getConfig(),
        ]);
        return Yii::createObject($config);
    }




    /**
     * 获取 httpclient 实例
     *
     * @return Client
     */
    public function getHttpclient()
    {
        return $this->_httpclient;
    }


    /**
     * 获取 httpclient 
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->_httpclient;
    }



    /**
     * 创建请求对象
     *
     * @return Request
     */
    public function createRequest()
    {
        $request = $this->getClient()->createRequest();
        $request->on(Request::EVENT_BEFORE_SEND, [$this, 'beforeRequest'], ['server' => $this]);
        $request->on(Request::EVENT_AFTER_SEND, [$this, 'afterRequest'], ['server' => $this]);
        return $request;
    }




    /**
     * 请求之前触发, 可以用于记录或者打印请求参数
     *
     * @param \yii\httpclient\RequestEvent $event
     * @return void
     */
    public function beforeRequest( $event )
    {
        $this->trigger(self::EVENT_BEFORE_REQUEST, $event);
    }





    /**
     * 请求之后触发, 可以用于记录或者打印请求或者响应参数
     *
     * @param \yii\httpclient\RequestEvent $event
     * @return void
     */
    public function afterRequest( $event )
    {
        $this->trigger(self::EVENT_AFTER_REQUEST, $event);
    }



    


}