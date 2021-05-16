<?php

namespace customer\frontend\controllers;

use frontend\controllers\Controller;
use Yii;
use customer\models\Address;
use customer\models\User;

/**
 * 地址控制器
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AddressController extends Controller
{

    /**
     * @var string  布局文件
     */
    public $layout = '@customer/frontend/views/layouts/center';


    /**
     * 用户地址管理
     *
     * @return void
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



    /**
     * 切换默认地址
     *
     * @return void
     */
    public function actionToggleDefault( $id )
    {
        $address = Address::findOne($id);
        /**
         * @var User $customer
         */
        $customer = Yii::$app->user->identity;
        if ($address->customer_id != Yii::$app->user->id) {
            return $this->_error([1, '地址不存在']);
        }

        $customer->default_address_id = $address->id;
        $customer->save();
        return $this->_success();
    }




    /**
     * 新增地址
     *
     * @return void
     */
    public function actionCreate()
    {
        /**
         * @var User $customer
         */
        $customer = Yii::$app->user->identity;
        $address = new Address([
            'customer' => $customer,
        ]);
        $address->loadDefaultValues();
        return $this->render('edit', [
            'address' => $address
        ]);
    }


    /**
     * 保存地址
     *
     * @return void
     */
    public function actionSave()
    {
        /**
         * @var User $customer
         */
        $customer = Yii::$app->user->identity;
        $request = Yii::$app->request;
        $id = $request->post('id');
        if(!$id) {
            $address = new Address(['customer' => $customer]);
        } else {
            $address = Address::findOne($id);
            if(!$address || $address->customer_id != $customer->id) {
                return $this->_error([1, '无法找到地址']);
            }
            $address->customer = $customer;
        }
        if ($address->load($this->request->post()) && $address->save()) {
            $isDefault = Yii::$app->request->post('is_default_address');

            if (empty($customer->default_address_id) || $isDefault) {
                $customer->default_address_id = $address->id;
                $customer->save();
            }
            return $this->_success();
        }
        $errors = $customer->getFirstErrors();
        $message = reset($errors);
        return $this->_error([2, $message]);
    }



    /**
     * 更新地址
     *
     * @param int $id
     * @return void
     */
    public function actionUpdate( $id )
    {
        $address = Address::findOne($id);
        /**
         * @var User $customer
         */
        $customer = Yii::$app->user->identity;
        if($address->customer_id != Yii::$app->user->id) {
            return $this->redirect(['index']);
        }
        $address->setCustomer($customer);
        return $this->render('edit', [
            'address' => $address,
        ]);
    }


    /**
     * 删除地址
     *
     * @param int $id
     * @return void
     */
    public function actionDelete( $id )
    {
        $address = Address::findOne($id);
        if ($address->customer_id != Yii::$app->user->id) {
            return $this->redirect(['index']);
        }
        $address->setCustomer(Yii::$app->user->identity);
        if(!$address->isDefault()) {
            $address->delete();
        }
        return $this->redirect(['index']);
    }





}