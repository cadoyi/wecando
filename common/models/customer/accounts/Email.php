<?php

namespace common\models\customer\accounts;

use Yii;


/**
 * 客户邮件账号
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