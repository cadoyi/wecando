<?php

namespace wxapi\common;

use Yii;
use yii\base\Component as BaseComponent;
use yii\base\InvalidConfigException;

/**
 * 通用组件类
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Component extends BaseComponent
{

    /**
     * API 调用的基本 URL, 基本上大部分场景不需要修改
     */
    const API_BASE_URL = 'https://api.weixin.qq.com';

    /**
     * URL 路径
     */
    const URL_PATH = '';


    /**
     * 构建 URL
     *
     * @param array $params  GET 参数
     * @param string $path  请求的路径
     * @return array  URL 
     */
    public function buildUrl( $params = [], $path = null )
    {
        if(is_null($path)) {
            $path = static::URL_PATH;
            if($path === "") {
                throw new InvalidConfigException('The const URL_PATH cannot be blank');
            }
            $url = static::API_BASE_URL . '/' . ltrim($path, '/');
        } else {
            if(!preg_match('/^https?:/', $path)) {
                $url = static::API_BASE_URL . '/' . ltrim($path, '/');
            } else {
                $url = $path;
            }
        }
        $params[0] = $url;
        return $params;
    }

    


}