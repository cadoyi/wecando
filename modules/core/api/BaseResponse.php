<?php

namespace core\api;

use Yii;
use yii\web\Response as WebResponse;
use yii\base\BaseObject;

/**
 * 响应组件
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class BaseResponse extends BaseObject
{

    /**
     * @var \yii\httpclient\Response
     */
    public $response;



    /**
     * 获取格式化后的响应内容
     *
     * @return array
     */
    public function getData()
    {
        return $this->response->data;
    }



    /**
     * 获取格式化前的响应内容
     *
     * @return string
     */
    public function getContent()
    {
        return $this->response->content;
    }




    /**
     * 请求是否成功
     *
     * @return bool
     */
    public function isOk()
    {
        return $this->response->isOk;
    }



    /**
     * 是否请求成功
     *
     * @return bool
     */
    public function getIsOk()
    {
        return $this->isOk();
    }



    /**
     * 获取错误码, 非 200 都代表错误
     *
     * @return int
     */
    public function getErrorCode()
    {
        $code = $this->response->getStatusCode();
        if($code !== 0 && empty($code)) {
            return 500;
        }
        return $code;
    }



    /**
     * 获取错误消息
     *
     * @return string
     */
    public function getErrorMessage()
    {
        $code = $this->getErrorCode();
        $statuses = WebResponse::$httpStatuses;
        if(isset($statuses[$code])) {
            return $statuses[$code];
        }
        return '未知状态码(' . $code . ')';
    }

    



}