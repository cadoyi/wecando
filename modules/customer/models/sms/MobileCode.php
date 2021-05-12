<?php

namespace customer\models\sms;

use core\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * 发送的手机号验证码
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MobileCode extends ActiveRecord
{

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{sms_mobile_code}}';
    }


    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => function ($event) {
                    return date('Y-m-d H:i:s');
                }
            ]
        ]);
    }
    

}