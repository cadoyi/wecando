<?php

namespace core\log;

use Yii;
use yii\base\Component;
use yii\db\Connection;


/**
 * 表相关的操作
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
abstract class Table extends Component
{

    /**
     * @var string  数据库
     */
    protected $_db = 'db';


    /**
     * @var string 日志的 key 名称
     */
    public $id;



    /**
     * @var string|null 表前缀, 如果不设置,则使用 log_ .$this->id 作为表前缀
     */
    public $prefix;



    /**
     * @var string|callback  表后缀, 如果不设置,则取当前年月作为后缀
     */
    public $suffix;


    /**
     * @var Config 配置对象
     */
    public $config;


    /**
     * @var Logger 日志组件
     */
    public $logger;


    /**
     * @var string 拼接后的表名称
     */
    protected $_tableName;


    /**
     * @var array 表数据
     */
    protected $_data;


    /**
     * @var string|array|null 条件
     */
    protected $_condition;



    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        if(is_null($this->prefix)) {
            $this->prefix = 'log_' . $this->id;
        }
    }


    /**
     * 获取 db 组件
     *
     * @return yii\db\Connection
     */
    public function getDb()
    {
        if(is_string($this->_db)) {
            $this->_db = Yii::$app->get($this->_db);
        }
        return $this->_db;
    }


    /**
     * 设置 db 组件
     *
     * @param string|array|Connection $db
     * @return void
     */
    public function setDb( $db )
    {
        if(is_string($db)) {
            $this->_db = Yii::$app->get($db);
        } elseif($db instanceof Connection)  {
            $this->_db = $db;
        } else {
            $this->_db = Yii::createObject($db);
        }
    }



    /**
     * 生成后缀名
     *
     * @return string
     */
    protected function generateSuffix()
    {
        return date('Ym');
    }

    /**
     * 获取表名称
     *
     * @return string
     */
    public function getTableName()
    {
        if (is_null($this->_tableName)) {
            $suffix = $this->suffix;
            if(is_null($suffix)) {
                $suffix = $this->generateSuffix();
            } elseif(is_callable($suffix)) {
                $suffix = call_user_func($suffix, $this);
            } 
            $this->_tableName =  $this->prefix . '_' . $suffix;
        }
        return $this->_tableName;
    }



    /**
     * 保存日志条目
     *
     * @param array $data  日志数据
     * @param array|string $condition 如果提供,表示更新
     * @return bool
     */
    public function save( $data, $condition = null )
    {
        $data = $this->prepare($data);
        $this->_data = $data;
        $this->_condition = $condition;         
        if(!$this->hasTable()) {
           $this->createTable();
        }

        if(is_null($condition)) {
            return $this->insert($data);
        }
        return $this->update($data, $condition);
    }




    /**
     * 检查表是否存在
     *
     * @return bool
     */
    public function hasTable()
    {
        $tableName = $this->getTableName();
        $this->getDb()->getSchema()->refreshTableSchema($tableName);
        return $this->getDb()->getTableSchema($tableName, true);
    }



    /**
     * 子类需要实现它来创建表结构
     *
     * @return void
     */
    abstract public function createTable();



    /**
     * 内部调用创建表结构
     *
     * @param array $columns  字段设置
     * @param string|null $options 表选项
     * @return bool
     */
    protected function _createTable($columns, $options = null)
    {
        return $this->getDb()
            ->createCommand()
            ->createTable($this->getTableName(), $columns, $options)
            ->execute();
    }


    /**
     * 添加索引
     *
     * @param string|array $columns  字段名
     * @param boolean $unique  是否为唯一索引
     * @return boolean
     */
    public function createIndex($columns, $unique = false)
    {
        $prefix = $unique ? 'UNQ_' : 'IDX_';
        $table = $this->getTableName();
        if (is_array($columns)) {
            $suffix = implode('_', $columns);
            $suffix = strtr($suffix, [
                '[' => '',
                ']' => '',
                '-' => '_',
            ]);
        } else {
            $suffix = $columns;
        }
        $name = strtoupper($prefix . $table . '_' . $suffix);
        return $this->getDb()
            ->createCommand()
            ->createIndex($name, $table, $columns, $unique)
            ->execute();
    }

    /**
     * 插入数据
     *
     * @param array $data  需要插入的数据
     * @return bool
     */
    public function insert($data, $tableName = null)
    {
        if ($tableName === null) {
            $tableName = $this->getTableName();
        }
        return $this->getDb()
             ->createCommand()
             ->insert($tableName, $data)
             ->execute();
    }


    /**
     * 更新数据
     *
     * @param array $data 需要更新的数据
     * @param string|array $condition  更新条件
     * @return bool
     */
    public function update($data, $condition)
    {
        $tableName = $this->getTableName();
        return $this->getDb()
            ->createCommand()
            ->update($tableName, $data, $condition)
            ->execute();
    }


}