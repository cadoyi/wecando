<?php

namespace wxapi\pub\base;

use Yii;

/**
 * api 接口
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Api extends Component
{

    /**
     * @var string 基础支持 access token
     */
    public $access_token;



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if(!$this->access_token) {
            $this->access_token = $this->server->getAccessToken();
        }
    }



    /**
     * @inheritDoc
     */
    public function buildUrl($params = [], $path = null)
    {
        if(!isset($params['access_token'])) {
            $params['access_token'] = $this->access_token;
        }
        return parent::buildUrl($params, $path);
    }

}