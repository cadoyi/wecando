<?php

namespace core\db\migrate;

use Yii;
use yii\db\Migration as BaseMigration;

/**
 * migration 类重写
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Migration extends BaseMigration
{

    /**
     * @var string 表名称
     */
    public $table;


    /**
     * @var string 表选项
     */
    public $tableOptions="Engine=InnoDB DEFAULT CHARSET=utf8";



    /**
     * @inheritDoc
     */
    public function primaryKey($length = null)
    {
        return parent::primaryKey($length)->unsigned();
    }



    /**
     * @inheritDoc
     */
    public function bigPrimaryKey($length = null)
    {
        return parent::bigPrimaryKey($length)->unsigned();
    }



    /**
     * 外键
     *
     * @param mixed $defaultValue
     *    false:  不允许为空
     *    null:  允许为空
     *    其他:  默认值
     * @return $this
     */
    public function fk( $defaultValue = false )
    {
        $fk = $this->integer()->unsigned();
        if($defaultValue === null) {
            return $fk;
        } elseif($defaultValue == false) {
            return $fk->notNull();
        }
        return $fk->notNull()->defaultValue($defaultValue);
    }



    /**
     * 添加索引
     *
     * @param string $table  表名
     * @param string|array $columns  字段名
     * @param bool $unique  是否为唯一索引
     * @return $this
     */
    public function addKey($table, $columns, $unique = false)
    {
        $name = $this->buildIndexName($table, $columns, $unique);
        return $this->createIndex($name, $table, $columns, $unique);
    }


    /**
     * 添加索引
     *
     * @param string $table  表名
     * @param string|array $columns  字段名
     * @param bool $unique  是否为唯一索引
     * @return $this
     */
    public function dropKey($table, $columns, $unique = false)
    {
        $name = $this->buildIndexName($table, $columns, $unique);
        return $this->dropIndex($name, $table);
    }



    /**
     * varchar 字段
     * 
     * @param  integer $length 
     * @return yii\db\ColumnSchemaBuilder
     */
    public function varchar($length = 255)
    {
        return $this->string($length);
    }



    /**
     * 构建 INDEX 名称
     * 
     * @param  string  $table  表名
     * @param  string|array  $field  字段名
     * @param  boolean $unique 是否唯一索引
     * @return string
     */
    protected function buildIndexName($table, $field, $unique = false)
    {
        $tableReplace = ['{' => '', '}' => '', '%' => '', '-' => '_'];
        $fieldReplace = ['[' => '', ']' => '', '-' => '_'];
        $table = strtr($table, $tableReplace);
        if (is_array($field)) {
            $field = implode('-', $field);
        }
        $field = strtr($field, $fieldReplace);
        $name = $unique ? 'UNQ' : 'IDX';
        return strtoupper($name . '_' . $table . '_' . $field);
    }




    /**
     * 构建命令
     *
     * @return void
     */
    public function build( $type, $length = null)
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder($type, $length);
    }



    /**
     * 打开或者关闭 foreign key 检查
     * 
     * @param  boolean $bool 是否打开
     */
    public function setForeignKeyChecks($bool = true)
    {
        $value = (int) $bool;
        $sql = "SET FOREIGN_KEY_CHECKS = {$value};";
        return $this->execute($sql);
    }



    /**
     * 开始执行命令前的语句
     * 
     * @return bool
     */
    public function begin()
    {
        return $this->setForeignKeyChecks(false);
    }



    /**
     * 结束执行命令
     *
     * @return bool
     */
    public function end()
    {
        return $this->setForeignKeyChecks(true);
    }



}