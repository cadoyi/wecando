<?php

namespace customer\models\sms;

use core\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * 邮件验证码
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class EmailCode extends ActiveRecord
{

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%sms_email_code}}';
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

}