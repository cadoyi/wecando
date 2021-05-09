<?php

namespace wxapi\pub\base;

use Yii;
use yii\base\InvalidConfigException;
use wxapi\common\Component;
use wxapi\pub\token\TokenServer;
use wxapi\pub\menu\MenuServer;


/**
 * 微信中控服务
 * 
 * @property Response $response  响应组件
 * @property Config $config  配置组件
 * @property SignValidator $signValidator 验证组件
 * @property \yii\httpclient\Client $client  请求客户端
 * 
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class BaseServer extends Component
{

    /**
     * @var \yii\redis\Connection  redis 组件
     */
    public $redis = 'redis';

    /**
     * @var string|array|Config 微信配置类, 配置包含 appid 以及 appsecret 等参数
     */
    protected $_config;


    /**
     * @var SignValidator 验证服务
     */
    protected $_signValidator;



    /**
     * @var Response 响应组件
     */
    protected $_response;



    /**
     * @var array  httpclient 配置
     */
    public $clientConfig = [
        'class' => 'yii\httpclient\Client',
        'transport' => [
            'class' => 'yii\httpclient\CurlTransport',
        ],
    ];



    /**
     * @var \yii\httpclient\Client
     */
    protected $_client;



    /**
     * @var string request 对象
     */
    protected $_request;


    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if(is_string($this->redis)) {
            $this->redis = Yii::$app->get($this->redis);
        }
    }




    /**
     * 实例化组件
     *
     * @return \yii\base\BaseObject
     */
    public function createObject($config  = [])
    {
        if(is_string($config)) {
            $config = ['class' => $config];
        }
        $config = array_merge($config, [
            'server' => $this,
        ]);
        return Yii::createObject($config);
    }



    /**
     * 获取微信配置类
     *
     * @return void
     */
    public function getConfig()
    {
        if ($this->_config instanceof Config) {
            return $this->_config;
        }
        $config = $this->_config;
        if (is_string($config)) {
            $config = ['class' => $config];
        } elseif (!is_array($config)) {
            throw new InvalidConfigException('The "config" param must be array or string');
        }
        if (!isset($config['class'])) {
            $config['class'] = Config::class;
        }
        $this->_config = Yii::createObject($config);
        return $this->_config;
    }





    /**
     * 设置 config 参数
     *
     * @param array $config
     * @return void
     */
    public function setConfig($config = [])
    {
        $this->_config = $config;
    }





    /**
     * 获取签名验证器
     *
     * @return SignValidator
     */
    public function getSignValidator()
    {
        if(!$this->_signValidator) {
            $this->_signValidator = $this->createObject(SignValidator::class);
        }
        return $this->_signValidator;
    }




    /**
     * 获取公众号推送过来的 echostr 进行验证
     *
     * @return bool|string
     */
    public function getEchoStr()
    {
        return $this->getSignValidator()->getEchoStr();
    }



    /**
     * 获取响应组件
     *
     * @return Response
     */
    public function getResponse()
    {
        if(is_null($this->_response)) {
            $this->_response = $this->createObject(Response::class);
        }
        return $this->_response;
    }



    /**
     * 获取 xml 请求对象
     *
     * @return XmlRequest
     */
    public function getRequest()
    {
        if(!$this->_request) {
            $this->_request = $this->createObject(XmlRequest::class);
        }
        return $this->_request;
    }


    /**
     * 发送 xml 数据
     *
     * @param array|string $data
     * @return void
     */
    public function sendXml($data)
    {
        $this->response->format = Response::FORMAT_XML;
        $this->response->data = $data;
        return $this->response->send();
    }



    /**
     * 发送 json 数据
     *
     * @param array $data  数据
     * @return void
     */
    public function sendJson($data)
    {
        $this->response->format = Response::FORMAT_JSON;
        $this->response->data = $data;
        return $this->response->send();
    }




    /**
     * 发送纯文本内容
     *
     * @param string $data  纯文本数据
     * @return void
     */
    public function sendRaw( $data )
    {
        $this->response->format = Response::FORMAT_RAW;
        $this->response->content = $data;
        return $this->response->send();
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
        return $this->response->redirect($url, $statusCode);
    }




    /**
     * 获取客户端组件
     *
     * @return \yii\httpclient\Client
     */
    public function getClient()
    {
        if(is_null($this->_client)) {
            $config = $this->clientConfig;
            $this->_client = Yii::createObject($config);
        }   
        return $this->_client;
    }


    
    /**
     * 获取基础支持 access token
     *
     * @return string|false
     */
    public function getAccessToken()
    {
        $key = 'wx:token:' . $this->config->appid;
        if($accessToken = $this->redis->get($key)) {
             return $accessToken;
        }
        $server = $this->createObject(TokenServer::class);
        $result = $server->run();
        if($result->isOk) {
            $accessToken = $result->get('access_token');
            $expiresIn = $result->get('expires_in');
            $this->redis->set($key, $accessToken, 'EX', $expiresIn - 200);
            return $accessToken;
        }
        return false;
    }



    public function setAccessToken( $token )
    {
        $key = 'wx:token:' . $this->config->appid;
        $this->redis->set($key, $token, 'EX', '3600');
    }



    /**
     * 刷新 access token
     *
     * @return void
     */
    public function refreshAccessToken()
    {
        $key = 'wx:token:' . $this->config->appid;
        $this->redis->del($key);
        return $this->getAccessToken();
    }




    /**
     * 菜单接口
     *
     * @return \wxapi\pub\menu\MenuServer
     */
    public function menu()
    {
        return $this->createObject(MenuServer::class);
    }


}