<?php

namespace wxapi\pub\base;

use Yii;
use yii\base\ExitException;
use yii\web\XmlResponseFormatter;

/**
 * 响应微信服务器
 * 
 * $response = $server->getResponse();
 * $response->format = 'json';
 * $response->data = ['errcode' => 0, 'errmsg' => 'OK'];
 * $response->send();
 * 
 * 
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Response extends Component
{

    /**
     * @var \wxapi\pub\base\BaseServer
     */
    public $server;

    /**
     * 响应格式为纯格式
     */
    const FORMAT_RAW  = 'raw';

    /**
     * 响应格式为 json 格式
     */
    const FORMAT_JSON = 'json';


    /**
     * 响应格式为 xml 格式
     */
    const FORMAT_XML  = 'xml';
    


    /**
     * @var string 响应格式
     */
    public $format = self::FORMAT_RAW;


    /**
     * @var array  响应数据
     */
    public $data = [];


    /**
     * @var string 响应内容
     */
    public $content;


    /**
     * 发送响应
     *
     * @return void
     */
    public function send()
    {
        $response = Yii::$app->getResponse();
        $response->clear();
        $response->setStatusCode(200);
        switch($this->format) {
            case self::FORMAT_RAW:
                if(is_null($this->content)) {
                    if(is_array($this->data)) {
                        $this->content = implode('', $this->data);
                    } elseif(is_null($this->data)) {
                        $this->content = '';
                    } else {
                        $this->content = $this->data;
                    }
                }
                $response->content = $this->content;
                break;
            case self::FORMAT_JSON:
                if(!is_null($this->content)) {
                    $response->format = self::FORMAT_RAW;
                    $response->content = $this->content;
                } else {
                    $response->format = $this->format;
                    $response->data = $this->data;
                }    
                break;            
            case self::FORMAT_XML:
                if (!is_null($this->content)) {
                    $response->format = self::FORMAT_RAW;
                    $response->content = $this->content;
                } else {
                    $response->format = $this->format;
                    $xmlFormatter = $response->formatters['xml'];
                    if(is_object($xmlFormatter)) {
                        $xmlFormatter->rootTag = 'xml';
                    } else {
                        $response->formatters['xml']['rootTag'] = 'xml';
                    }
                    $response->data   = $this->data;
                }   
                break;
            default:
                if(!isset($response->content)) {
                    $response->content = $response->data;
                }
                break;
        }
        return $response->send();
    }





    /**
     * 进行重定向
     *
     * @param string $url  重定向的 URL
     * @param int $statusCode 状态码
     * @return void
     */
    public function redirect($url, $statusCode = 302)
    {
        $response = Yii::$app->response;
        $response->redirect($url, $statusCode);
        $response->send();
        throw new ExitException();
    }








}