<?php

namespace customer\models;


use Yii;
use yii\behaviors\TimestampBehavior;
use core\db\ActiveRecord;
use customer\models\User as Customer;


/**
 * 地址
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Address extends ActiveRecord
{


    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{customer_address}}';
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
            ]
        ]);
    }


    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
           [['username', 'mobile', 'province', 'city', 'distinct', 'street'], 'required'],
           [['remark'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'username'  => '姓名',
            'mobile'    => '手机号',
            'province'  => '省份',
            'city'      => '城市',
            'distinct'  => '乡/镇/地区',
            'street'    => '街道',
            'remark'    => '标签',
        ];
    }




    /**
     * 获取 customer
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }




    /**
     * 设置 customer
     *
     * @param Customer $customer
     * @return void
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->populateRelation('customer', $customer);
    }



    /**
     * 是否为默认地址
     *
     * @return bool
     */
    public function isDefault()
    {
        $customer = $this->customer;
        if($customer->default_address_id == $this->id) {
            return true;
        }
        return false;
    }


}