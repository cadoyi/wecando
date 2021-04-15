<?php

namespace wxapi\pub\base;

use Yii;
use yii\base\Component;

/**
 * 执行结果显示
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Result extends Component
{

    /**
     * @var \yii\httpclient\Request
     */
    public $request;


    /**
     * @var \yii\httpclient\Response
     */
    public $response;


    /**
     * @var \wxapi\pub\base\Component
     */
    public $api;


    /**
     * @var BaseServer
     */
    public $server;





    /**
     * 请求是否 ok
     *
     * @return bool
     */
    public function isOk()
    {
        return !$this->hasError();
    }



    /**
     * 属性访问方式检查是否 ok
     *
     * @return bool
     */
    public function getIsOk()
    {
        return $this->isOk();
    }



    /**
     * 是否有错误
     *
     * @return bool
     */
    public function hasError()
    {
        if(!$this->response->isOk) {
            return true;
        }
        return $this->api->hasError($this->response);
    }



    /**
     * 获取错误码
     *
     * @return int
     */
    public function getErrorCode()
    {
        return $this->api->getErrorCode($this->response);
    }


    /**
     * 获取错误码
     *
     * @return int
     */
    public function getCode()
    {
        return $this->getErrorCode();
    }


    /**
     * 获取错误消息
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->api->getErrorMessage( $this->response );
    }



    /**
     * 获取错误消息
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getErrorMessage();
    }



    /**
     * 获取响应数据
     *
     * @return \wxapi\pub\httpclient\Data
     */
    public function getData()
    {
        return $this->api->getData( $this->response );
    }




    /**
     * 获取参数
     *
     * @param string $name  参数
     * @param mixed $defaultValue 默认值
     * @return mixed
     */
    public function get($name = null, $defaultValue = null)
    {
        if (is_null($name)) {
            return $this->getData()->data;
        }
        return $this->getData()->get($name, $defaultValue);
    }
}