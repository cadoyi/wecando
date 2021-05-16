<?php

namespace customer\models\account;


use Yii;
use core\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use customer\models\User; 


/**
 * 账号基类
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
abstract class Account extends ActiveRecord
{

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
            ],
        ]);
    }



    

    /**
     * 获取用户表数据
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::class, ['id' => 'customer_id']);
    }



    /**
     * 设置 user 对象
     *
     * @param User $user
     * @return void
     */
    public function setCustomer( User $customer )
    {
        $this->customer_id = $customer->id;
        $this->populateRelation('user', $customer);
    }


    

}