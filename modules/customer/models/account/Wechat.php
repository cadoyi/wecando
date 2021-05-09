<?php

namespace customer\models\account;


use Yii;

/**
 * 微信账号
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Wechat extends Account
{

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%customer_account_wechat}}';
    }

}