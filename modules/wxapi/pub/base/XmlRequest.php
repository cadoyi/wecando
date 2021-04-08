<?php

namespace wxapi\pub\base;

use Yii;

/**
 * 获取 xml 请求对象
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class XmlRequest extends Component
{

    protected $_data;


    /**
     * 获取纯请求数据
     *
     * @return string
     */
    public function getRawData()
    {
        return Yii::$app->getRequest()->getRawBody();
    }


    /**
     * 获取解析后的数据
     *
     * @return void
     */
    public function getData()
    {
        if(is_null($this->_data)) {
            $request = Yii::$app->request;
            if(isset($request->parsers['application/xml'])) {
                $this->_data = $request->getBodyParams();
            } else {
                $this->_data = $this->parseXml($this->getRawData());
            }
        }
        return $this->_data;
    }



    /**
     * 解析 XML 请求
     *
     * @param string $data  XML 数据
     * @return array
     */
    public function parseXml( $xml )
    {
        $data = [];
        try {
            $data = (array) simplexml_load_string($xml);
            $data = $this->parseXMLArray($data);
        } catch(\Exception $e) {
        } catch(\Throwable $e) {
        }
        return $data;
    }


    /**
     * 深入处理
     *
     * @param array  $data  xml 转换成的数组
     * @return array
     */
    public function parseXMLArray($data)
    {
        foreach($data as $k => $v) {
            if($v instanceof \SimpleXMLElement) {
                $data[$k] = (string) $v;
            } elseif(is_array($v)) {
                $data[$k] = $this->parseXMLArray($v);
            } else {
                $data[$k] = $v;
            }
        }
        return $data;
    }



    /**
     * 获取请求参数
     *
     * @param string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get($name, $defaultValue = null)
    {
        if($this->has($name)) {
            return $this->data[$name];
        }
        return $defaultValue;
    }


    /**
     * 是否有某个请求参数
     *
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->data[$name]) || array_key_exists($name, $this->data);
    }

}