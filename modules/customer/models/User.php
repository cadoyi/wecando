<?php

namespace customer\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use core\db\ActiveRecord;

/**
 * 用户组件
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
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status' => 1,
        ]);
    }




    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne([
            'access_token' => $token,
            'status'       => 1,
        ]);
    }




    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        $authKey = md5($this->created_at . ':' . $this->id);
        return $authKey;
    }



    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }




}