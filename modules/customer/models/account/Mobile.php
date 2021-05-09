<?php

namespace customer\models\account;


use Yii;

/**
 * 手机账号
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Mobile extends Account
{


    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%customer_account_mobile}}';
    }


}