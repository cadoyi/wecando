<?php

namespace customer\models\account;


use Yii;

/**
 * 手机账号
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Mobile extends PasswordAccount
{


    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%customer_account_mobile}}';
    }



    /**
     * 设置用户名
     *
     * @param string $username
     * @return void
     */
    public function setUsername( $username )
    {
        $this->mobile = $username;
    }


}