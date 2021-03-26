<?php

namespace core\log;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * 表的配置
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Config extends Component
{

    /**
     * @var Logger  日志组件
     */
    public $logger;


    /**
     * @var string 存储配置的文件名路径, 支持别名
     */
    public $filename;
    

    /**
     * @var array 配置文件中配置的数据
     * 
     *  return [
     *     'customer_visit' => [
     *          'class'  => 'name\space\to\TableClass',
     *          'prefix' => 'log_customer_visit',  //表前缀名称 
     *     ],
     *  ]
     * 
     */
    protected $_data;



    /**
     * 获取配置数据
     *
     * @return array
     */
    public function getData( $key = null )
    {
        if(is_null($this->_data)) {
            $this->_data = $this->readFile();
        }
        if($key === null) {
            return $this->_data;
        }
        return array_key_exists($key, $this->_data) ? $this->_data[$key] : null;
    }



    /**
     * 读取文件
     *
     * @return array
     */
    protected function readFile()
    {
        $file = $this->filename;
        if(strncmp($file, '@', 1) === 0) {
            $file = Yii::getAlias($file);
        }
        if(strpos($file, '.php', 1) === false) {
            $file .= '.php';
        }
        if(!file_exists($file) || !is_readable($file)) {
            throw new InvalidConfigException('The file ' . $file . ' not exists.');
        }
        $data = require $file;
        if(!is_array($data)) {
            throw new InvalidConfigException('The file content ' . $file . ' must be array');
        }
        return $data;
    }




    /**
     * 获取对应的表配置
     *
     * @param string $key key 值
     * @return Table
     */
    public function getTable($key)
    {
        $config = $this->getData($key);
        if(is_string($config)) {
            $config = ['class' => $config];
        }
        $config['config'] = $this;
        $config['logger'] = $this->logger;
        $config['id'] = $key;
        $config = Yii::createObject($config);
        return $config;
    }







}