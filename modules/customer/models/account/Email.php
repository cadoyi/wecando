<?php

namespace customer\models\account;


use Yii;
use core\db\ActiveRecord;


/**
 * 邮件账号
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Email extends Account
{

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%customer_account_email}}';
    }


}