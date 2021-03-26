<?php

namespace core\db;

use yii\caching\TagDependency;

/**
 * 查询提供一个 tableCache() 方法, 可以保证表级别的缓存
 * 
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
trait ActiveQueryCacheTrait
{

    /**
     * 表缓存, 每次表有更新的时候会自动刷新缓存
     * 
     * $user = User::find()
     *    -> andWhere(['openid' => $openid ])
     *    -> tableCache()
     *    -> one();
     * 
     * 下次访问的时候可以直接刷新缓存
     *    刷新时机:
     *         保存之后
     *         删除之后
     * User::flushTableCache();
     *
     * @param int|true $duration  缓存过期时间
     *    当为 true 的时候, 表示使用 db 上配置的 queryCacheDuration 参数
     *    当为  0 的时候, 表示永不过期
     *    其他表示过期时间, 单位为秒
     *    
     * @return $this
     */
    public function tableCache($duration = true)
    {
        $class = $this->modelClass;
        $tableName = $class::tableName();
        $dependency = new TagDependency([
            'tags' => [$tableName],
        ]);
        return $this->cache($duration, $dependency);
    }


}