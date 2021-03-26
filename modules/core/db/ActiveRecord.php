<?php

namespace core\db;

use Yii;

/**
 * 继承核销方法, 方便统一修改
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    use ActiveRecordCacheTrait;


    /**
     * @inheritDoc
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::class, [ get_called_class() ]);
    }





}