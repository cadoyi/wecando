<?php

namespace core\db;

use Yii;


/**
 * 继承核心方法,方便统一进行修改
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class ActiveQuery extends \yii\db\ActiveQuery
{
    use ActiveQueryCacheTrait;
    

}