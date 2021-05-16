<?php

namespace customer\frontend\models;


use Yii;
use customer\models\sms\MobileCode;
use customer\models\sms\EmailCode;


/**
 * 验证码登录方式
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class CaptchaLoginForm extends CaptchaForm
{


    /**
     * @var int 发送的验证码
     */
    public $code;


    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message' => '请填写手机号或者邮箱'],
            ['code', 'required', 'message' => '请输入验证码'],
            ['code', 'validateCode'],
        ];
    }



    /**
     * 验证验证码
     *
     * @return void
     */
    public function validateCode()
    {
        $data = $this->getSavedCode();
        if(!$data || !isset($data['code'])) {
            return $this->addError('code', '验证码不正确');
        }
        if($data['username'] != $this->username) {
           return $this->addError('code', '验证码不正确');
        }
        if(time() > $data['expire']) {
            return $this->addError('code', '验证码已过期');
        }
    }




    /**
     * @inheritDoc
     */
    public function clearCode()
    {
        $data = $this->getSavedCode();
        if($this->isMobile()) {
            $log = MobileCode::find()
                ->andWhere(['mobile' => $this->username])
                ->andWhere(['code' => $data['code']])
                ->orderBy(['id' => SORT_DESC])
                ->limit(1)
                ->one();
        } else {
            $log = EmailCode::find()
                ->andWhere(['email' => $this->username])
                ->andWhere(['code' => $data['code']])
                ->orderBy(['id' => SORT_DESC])
                ->limit(1)
                ->one();
        }
        $log->verified = 1;
        $log->save();
    }

    /**
     * 开始登陆
     *
     * @return void
     */
    public function login()
    {
        if(!$this->validate()) {
            return false;
        }
        $this->clearCode();
        $user = $this->getUser();
        $customer = $user->customer;
        return Yii::$app->user->login($customer);
    }

}