<?php

namespace customer\frontend\models;

use Yii;
use customer\models\sms\MobileCode;
use customer\models\sms\EmailCode;


/**
 * 发送验证码的吧表单
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class SendCodeForm extends CaptchaForm
{


    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username','validateUsername'],
        ];
    }



    /**
     * 开始发送
     *
     * @return void
     */
    public function sendCode()
    {
        $code = rand(100000, 999999);
        if(preg_match('/^1\d{10}$/', $this->username)) {
            $result = $this->sendMobileCode($code);
        } else {
            $result = $this->sendEmailCode($code);
        }
        if($result) {
            $this->saveCode($code);
        }
        return $result;
    }



    /**
     * 发送手机验证码
     *
     * @param string $code  验证码
     * @return bool
     */
    public function sendMobileCode($code)
    {
        $count = MobileCode::find()
            ->andWhere(['between', 'created_at', date('Y-m-d 00:00:00'), date('Y-m-d H:i:s')])
            ->count();
        if($count >= 10) {
            $this->addError('username', '今日验证码已经达到上限');
            return false;
        }
        $model = new MobileCode([
            'action'     => 'login',
            'mobile'     => $this->username,
            'code'       => $code,
        ]);
        $model->save();
        return true;
    }



    /**
     * 发送邮件验证码
     *
     * @param string $code 验证码
     * @return bool
     */
    public function sendEmailCode( $code )
    {
        $count = EmailCode::find()
            ->andWhere(['between', 'created_at', date('Y-m-d 00:00:00'), date('Y-m-d H:i:s')])
            ->count();
        if ($count >= 10) {
            $this->addError('username', '今日验证码已经达到上限');
            return false;
        }
        $model = new EmailCode([
            'action'     => 'login',
            'email'      => $this->username,
            'code'       => $code,
        ]);
        $model->save();
        return true;
    }






}