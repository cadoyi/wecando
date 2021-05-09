<?php

namespace core\api;

use Yii;
use yii\httpclient\Request;

/**
 * api 组件
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Component extends \yii\base\Component
{

    /**
     * @var string 基本 URL
     */
    public $baseUrl;


    /**
     * @var string 请求之前触发, 有 request 对象
     */
    const EVENT_BEFORE_REQUEST = 'beforeRequest';



    /**
     * @var string 请求之后触发, 有 request 和 response 对象
     */
    const EVENT_AFTER_REQUEST = 'afterRequest';



    /**
     * @var BaseServer  server 组件
     */
    public $server;


    /**
     * @var BaseConfig  配置组件
     */
    public $config;



    /**
     * @var BaseResponse 最后一次的响应对象
     */
    public $response;



    /**
     * @var string 响应结果类, 如果不设置,则使用 server 中配置的响应结果类
     */
    public $responseClass;



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if(is_null($this->responseClass)) {
            $this->responseClass = $this->server->responseClass;
        }
        if(empty($this->baseUrl)) {
            $this->baseUrl = $this->server->baseUrl;
        }
    }



    /**
     * 获取 server 组件
     *
     * @return BaseServer
     */
    public function getServer()
    {
        return $this->server;
    }



    /**
     * 获取 config 组件
     *
     * @return BaseConfig
     */
    public function getConfig()
    {
        return $this->config;
    }




    /**
     * 创建请求对象
     *
     * @return \yii\httpclient\Request
     */
    public function createRequest()
    {
        $request = $this->getServer()->createRequest();
        $request->on(Request::EVENT_BEFORE_SEND, [$this, 'beforeRequest'], ['api' => $this]);
        $request->on(Request::EVENT_AFTER_SEND, [$this, 'afterRequest'], ['api' => $this]);
        return $request;
    }



    /**
     * 请求之前触发
     * 
     * @param \yii\httpclient\RequestEvent $event
     * @return void
     */
    public function beforeRequest( $event )
    {
        $this->trigger(self::EVENT_BEFORE_REQUEST, $event);
    }



    /**
     * 请求之后触发
     *
     * @param \yii\httpclient\RequestEvent $event
     * @return void
     */
    public function afterRequest( $event )
    {
        $response = $event->response;
        $class = $this->responseClass;
        $this->response = new $class(['response' => $response]);
        $this->trigger(self::EVENT_AFTER_REQUEST, $event);
    }





    /**
     * Creates 'GET' request.
     * 
     * @param array|string $url target URL.
     * @param array|string $data if array - request data, otherwise - request content.
     * @param array $headers request headers.
     * @param array $options request options.
     * @return Request request instance.
     */
    public function get($url, $data = null, $headers = [], $options = [])
    {
        return $this->sendRequestShortcut('GET', $url, $data, $headers, $options);
    }





    /**
     * Creates 'POST' request.
     * 
     * @param array|string $url target URL.
     * @param array|string $data if array - request data, otherwise - request content.
     * @param array $headers request headers.
     * @param array $options request options.
     * @return Request request instance.
     */
    public function post($url, $data = null, $headers = [], $options = [])
    {
        return $this->sendRequestShortcut('POST', $url, $data, $headers, $options);
    }





    /**
     * Creates 'PUT' request.
     * 
     * @param array|string $url target URL.
     * @param array|string $data if array - request data, otherwise - request content.
     * @param array $headers request headers.
     * @param array $options request options.
     * @return Request request instance.
     */
    public function put($url, $data = null, $headers = [], $options = [])
    {
        return $this->sendRequestShortcut('PUT', $url, $data, $headers, $options);
    }





    /**
     * Creates 'PATCH' request.
     * 
     * @param array|string $url target URL.
     * @param array|string $data if array - request data, otherwise - request content.
     * @param array $headers request headers.
     * @param array $options request options.
     * @return Request request instance.
     */
    public function patch($url, $data = null, $headers = [], $options = [])
    {
        return $this->sendRequestShortcut('PATCH', $url, $data, $headers, $options);
    }




    /**
     * Creates 'DELETE' request.
     * 
     * @param array|string $url target URL.
     * @param array|string $data if array - request data, otherwise - request content.
     * @param array $headers request headers.
     * @param array $options request options.
     * @return Request request instance.
     */
    public function delete($url, $data = null, $headers = [], $options = [])
    {
        return $this->sendRequestShortcut('DELETE', $url, $data, $headers, $options);
    }




    /**
     * Creates 'HEAD' request.
     * 
     * @param array|string $url target URL.
     * @param array $headers request headers.
     * @param array $options request options.
     * @return Request request instance.
     */
    public function head($url, $headers = [], $options = [])
    {
        return $this->sendRequestShortcut('HEAD', $url, null, $headers, $options);
    }




    /**
     * Creates 'OPTIONS' request.
     * 
     * @param array|string $url target URL.
     * @param array $options request options.
     * @return Request request instance.
     */
    public function options($url, $options = [])
    {
        return $this->sendRequestShortcut('OPTIONS', $url, null, [], $options);
    }



    /**
     * 请求简单方法
     * 
     * @param string $method
     * @param array|string $url
     * @param array|string $data
     * @param array $headers
     * @param array $options
     * @return Request request instance.
     * @throws \yii\base\InvalidConfigException
     */
    protected function sendRequestShortcut($method, $url, $data, $headers, $options)
    {
        $request = $this->createRequest()
            ->setMethod($method)
            ->setUrl($url)
            ->addHeaders($headers)
            ->addOptions($options);
        if (is_array($data)) {
            $request->setData($data);
        } else {
            $request->setContent($data);
        }
        $request->send();
        return $this->response;
    }




    /**
     * 创建可以被使用的 URL
     *
     * @param string $url  相对或者绝对 URL
     * @param array $params  get 参数
     * @return array
     */
    public function createUrl($url, $params = [])
    {
        if(!empty($this->baseUrl) && !preg_match('/^https?/', $url)) {
            $url = rtrim($this->baseUrl, '/') . '/' . ltrim($url, '/');
        }
        $params[0] = $url;
        return $params;
    }





}