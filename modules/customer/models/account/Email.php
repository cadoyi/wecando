<?php

namespace customer\models\account;


use Yii;
use core\db\ActiveRecord;


/**
 * 邮件账号
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Email extends PasswordAccount
{

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%customer_account_email}}';
    }



    /**
     * 设置用户名
     *
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->email = $username;
    }


}