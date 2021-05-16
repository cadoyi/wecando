<?php

namespace customer\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use core\db\ActiveRecord;


/**
 * 用户角色表
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Role extends ActiveRecord
{

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{customer_user_role}}';
    }


    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => function ($event) {
                    return date('Y-m-d H:i:s');
                }
            ]
        ]);
    }



    /**
     * 获取 user 实例
     *
     * @return void
     */
    public function getCustomer()
    {
        return $this->hasOne(User::class, ['id' => 'customer_id'])
            ->inverseOf('role');
    }


    




}