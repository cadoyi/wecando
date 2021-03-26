<?php

namespace core\db;

use Yii;
use yii\caching\CacheInterface;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;

/**
 * 如果 activeQuery 附加了 ActiveQueryCacheTrait 则这里提供保存自动刷新机制.
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
trait ActiveRecordCacheTrait
{

    /**
     * 覆盖构造器, 实现构造器方法,并附加缓存
     *
     * @param array $config  构造器参数
     */
    public function __construct( $config = [] )
    {
        parent::__construct($config);
        $this->attachCacheEvent();
    }


    /**
     * 刷新 tableCache 方法
     *
     * @return void
     */
    public static function flushTableCache( $tags = [] )
    {
        $tableName = static::tableName();
        if(!in_array($tableName, $tags)) {
            $args[] = $tableName;
        }
        $db = static::getDb();
        if (is_string($db->queryCache)) {
            $cache = Yii::$app->get($db->queryCache, false);
        } else {
            $cache = $db->queryCache;
        }
        if ($cache instanceof CacheInterface) {
            $db->queryCache = $cache;
            TagDependency::invalidate($cache, $tags);
        }
    }



    /**
     * 附加缓存事件
     *
     * @return void
     */
    protected function attachCacheEvent()
    {
        $handle = function() {
            static::flushTableCache();
        };
        $this->on(ActiveRecord::EVENT_AFTER_INSERT, $handle);
        $this->on(ActiveRecord::EVENT_AFTER_UPDATE, $handle);
        $this->on(ActiveRecord::EVENT_AFTER_DELETE, $handle);
    }





}