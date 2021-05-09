<?php

namespace wxapi\pub\httpclient;

use Yii;
use yii\helpers\ArrayHelper;
use wxapi\pub\base\Component;

/**
 * 响应数据
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Data extends Component
{

    protected $_data = [];



    /**
     * 设置数据
     *
     * @param array $data
     * @return void
     */
    public function setData( $data )
    {
         $this->_data = $data;
    }


    /**
     * 获取响应数据
     *
     * @return array
     */
    public function getData( $response = null )
    {
        return $this->_data;
    }



    /**
     * 获取参数
     *
     * @param string $name  参数
     * @param mixed $defaultValue 默认值
     * @return mixed
     */
    public function get( $name = null, $defaultValue = null )
    {
        if(is_null($name)) {
            return $this->getData();
        }
        return ArrayHelper::getValue($this->data, $name, $defaultValue);
    }

    



}