<?php

namespace common\models\customer\accounts;

use Yii;
use core\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\models\customer\User;

/**
 * 登录账号基类
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
                'value' => function( $event ) {
                    return date('Y-m-d H:i:s');
                } 
            ],
        ]);
    }



    /**
     * 获取客户用户表
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->findOne(User::class, ['id' => 'customer_id']);
    }



    /**
     * 执行登录操作
     *
     * @return bool
     */
    public function login($duration = 0, $user = null)
    {
        if($user === null) {
            $user = Yii::$app->user;
        } elseif(is_string($user)) {
            $user = Yii::$app->get($user);
        }
        return $user->login($this->user, $duration);
    }




}
