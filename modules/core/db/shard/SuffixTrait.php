<?php

namespace core\db\shard;

use Yii;


/**
 * 表后缀分片 trait
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
trait SuffixTrait
{

    /**
     * @var string 表后缀名
     */
    private static $_tableSuffix = '';


    /**
     * @var int  数据库索引
     */
    private static $_db;



    /**
     * @inheritDoc
     */
    public static function getDb()
    {
        if (is_string(self::$_db)) {
            return Yii::$app->get(self::$_db);
        } elseif (is_null(self::$_db)) {
            return Yii::$app->db;
        }
        return self::$_db;
    }




    /**
     * 子类需要实现它, 进行配置
     *
     * @return array
     *    prefix:  表前缀, 不要带下划线, 我会自动加上.不要带 {{%}}
     *        这也是默认的表名称,获取字段都是从这里获取的
     * 
     *    suffix:  string | callback 字符串或者回调函数
     * 
     *    getDb: callback   function(timestamp)
     */
    public static function shardingConfig()
    {
    }



    /**
     * 开始分片
     *
     * @return void
     */
    public static function sharding($value)
    {
        $config = static::shardingConfig();
        $suffix = $config['suffix'];
        if (is_string($suffix) || is_numeric($suffix)) {
            self::$_tableSuffix = $suffix;
        } else {
            self::$_tableSuffix = call_user_func($suffix, $value);
        }
        if (isset($config['getDb'])) {
            $db = $config['getDb'];
            if ($db instanceof \Closure) {
                $db = call_user_func($db, $value, self::$_tableSuffix);
            }
            self::$_db = $db;
        }
    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        $config = static::shardingConfig();
        $tableName = $config['prefix'];
        if (self::$_tableSuffix) {
            $tableName .= '_' . self::$_tableSuffix;
        }
        return '{{%' . $tableName . '}}';
    }



}
