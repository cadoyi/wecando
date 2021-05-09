<?php

namespace customer\frontend\models;


use Yii;
use yii\base\Model;
use customer\models\account\Email;
use customer\models\account\Mobile;

/**
 * 密码登录表单
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class PasswordLoginForm extends Model
{
    const ACCOUNT_MOBILE = 'mobile';
    const ACCOUNT_EMAIL = 'email';

    /**
     * @var string 用户名
     */
    public $username;


    /**
     * @var string 密码
     */
    public $password;


    /**
     * @var string 账号类型
     */
    public $type;


    protected $_user;



    /**
     * @inheritDoc
     */
    public function rules()
    {
        $message = '用户名或密码不正确';
        return [
           [['username', 'password'], 'required', 'message' => $message],
           ['username', function() use ($message) {
               if(!$this->getUser()) {
                   $this->addError('username', $message);
               }
           }],
           ['password', function() use ($message) {
               if(!$this->validatePassword()) {
                   $this->addError('username', $message);
               }
           }],
        ];
    }



    /**
     * 获取 user 
     *
     * @return Mobile|Email
     */
    public function getUser()
    {
        if(!is_null($this->_user)) {
            return $this->_user;
        }
        $isMobile = preg_match('/^\d$/', $this->username);
        $this->type = $isMobile ? 'mobile' : 'email';
        if($isMobile) {
            $user = Mobile::findOne(['mobile' => $this->username]);
        } else {
            $user = Email::findOne(['email' => $this->username]);
        }
        $this->_user = $user ?: false;
        return $this->_user;
    }





    /**
     * 验证密码
     * 
     * @return bool
     */
    public function validatePassword()
    {
        return $this->getUser()->validatePassword($this->password);
    }





    /**
     * 登录
     *
     * @return bool
     */
    public function login()
    {
        if(!$this->validate()) {
            return false;
        }
        $account = $this->getUser();
        $user = $account->user;
        return Yii::$app->user->login($user);
    }




    /**
     * 获取错误消息
     *
     * @return void
     */
    public function getErrorMessage()
    {
        $errors = $this->getFirstErrors();
        return reset($errors);
    }



}