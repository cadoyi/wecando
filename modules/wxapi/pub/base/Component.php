<?php

namespace wxapi\pub\base;

use Yii;
use yii\httpclient\Client;
use yii\httpclient\Request;
use yii\httpclient\Response;
use wxapi\pub\httpclient\Data;
use wxapi\common\Component as APIComponent;
use yii\base\InvalidConfigException;

/**
 * 微信公众号基本组件
 * 
 * @property Config $config 
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Component extends APIComponent
{

    /**
     * @var BaseServer
     */
    public $server;


    /**
     * @var \yii\httpclient\Client
     */
    protected $_client;


    /**
     * @var \yii\httpclient\Request
     */
    protected $_request;

    /**
     * @var \yii\httpclient\Response
     */
    protected $_response;




    /**
     * 获取配合组件
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->server->config;
    }




    /**
     * 获取客户端组件
     *
     * @return \yii\httpclient\Client
     */
    public function getClient()
    {
        return $this->server->getClient();
    }



    /**
     * 创建请求对象
     *
     * @return Request
     */
    public function createRequest()
    {
        $request = $this->getClient()->createRequest();
        $request->on(Request::EVENT_BEFORE_SEND, function( $event ) {
            $this->beforeRequest($event->request);
        });
        $request->on(Request::EVENT_AFTER_SEND, function( $event ) {
            $this->afterRequest($event->request, $event->response);
        });
        return $request;
    }




    /**
     * 请求之前, 这里可以加一个请求日志
     *
     * @param Request $request  请求对象
     * @return void
     */
    public function beforeRequest( $request )
    {
        $this->_response = null;
        $this->_request = $request;
    }


    /**
     * 请求之后, 这里可以加一个响应日志
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function afterRequest( $request, $response )
    {
        $this->_request = $request;
        $this->_response = $response;
    }




    /**
     * 请求是否出错
     *
     * @param \yii\httpclient\Response $response
     * @return false | array
     */
    public function hasError( $response  = null )
    {
        if(is_null($response)) {
            $response = $this->_response;
        }
        $data = $response->data;
        $isError =  isset($data['errcode']) && isset($data['errmsg']) && $data['errcode'] != 0;
        return $isError;
    }



    /**
     * 获取错误信息
     *
     * @param Response $response
     * @return array
     */
    public function getErrorCode()
    {
        if($this->hasError()) {
            return $this->_response->data['errcode'];
        }
        return 0;
    }



    /**
     * 获取错误消息
     *
     * @return void
     */
    public function getErrorMessage()
    {
        if($this->hasError()) {
            return $this->_response->data['errmsg'];
        }
        return 'OK';
    }



    /**
     * 获取返回信息
     *
     * @return bool|Data
     */
    public function getData()
    {
        if($this->hasError()) {
            return false;
        }
        return new Data([
            'data' => $this->_response->data,
        ]);
    }



}
