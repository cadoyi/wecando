<?php

namespace common\models\customer;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use core\db\ActiveRecord;

/**
 * 客户用户表
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class User extends ActiveRecord implements IdentityInterface
{


    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%customer_user}}';
    }


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
     * 确保用户存在, 也就是创建用户
     *
     * @param array $config
     * @return $this
     */
    public static function create( $config = [] )
    {
        $user = new static($config);
        $user->save();
        return $user;
    }


    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * 设置 ID 
     *
     * @return void
     */
    public function setId( $id )
    {
        $this->id = $id;
    }



    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id'     => $id,
            'status' => 1,
        ]);
    }


    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }



    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return null;
    }


    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }





}

