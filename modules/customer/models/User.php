<?php

namespace customer\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use core\db\ActiveRecord;

/**
 * 用户组件
 *
 * @property Role $roleModel
 * @property Role $role
 * @property Address[] $addesses
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class User extends ActiveRecord implements IdentityInterface
{

    /**
     * @var Address 保存默认地址
     */
    protected $_defaultAddress;


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




    /**
     * 获取 role 模型
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoleModel()
    {
        return $this->hasOne(Role::class, ['customer_id' => 'id'])
            ->inverseOf('user');
    }


    /**
     * 获取 role
     *
     * @return void
     */
    public function getRole()
    {
        if(!$this->roleModel) {
            $roleModel = new Role([
                'customer'   => $this,
                'role'       => 0,
                'integral'   => 0,
                'experience' => 0,
                'up_time'    => $this->created_at,
                'down_time'  => date('Y-m-d H:i:s', strtotime("+1 year", strtotime($this->created_at))),
            ]);
            $roleModel->save();
            $this->populateRelation('roleModel', $roleModel);
            $roleModel->populateRelation('customer', $this);
        }
        return $this->roleModel;
    }



    /**
     * 查找地址
     *
     * @return \yii\db\ActiveQuery
     */
    public function queryAddress()
    {
        return Address::find()
            ->andWhere(['customer_id' => $this->id]);
    }



    /**
     * 获取默认地址
     *
     * @return Address|null
     */
    public function getDefaultAddress()
    {
        if(!$this->default_address_id) {
            return null;
        }
        if(!$this->_defaultAddress) {
           $this->_defaultAddress = $this->queryAddress()
            ->andWhere(['id' =>$this->default_address_id])
            ->one();
        }
        return $this->_defaultAddress;
    }



    /**
     * 获取所有地址
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {  
        return $this->hasMany(Address::class, [
            'customer_id' => 'id'
        ])->inverseOf('customer');
    }




}