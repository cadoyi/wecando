<?php

namespace customer\frontend\models;

use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;
use customer\models\account\Mobile;
use customer\models\account\Email;


/**
 * 验证码登录和发送的基类
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
abstract class CaptchaForm extends Model
{

    /**
     * 保存到 session 中的键
     */
    const CODE_SESSION_KEY = 'captcha_login_code';


    /**
     * @var string 用户名
     */
    public $username;


    protected $_user;


    /**
     * 是否为手机号
     *
     * @return bool
     */
    public function isMobile()
    {
        return preg_match('/^1\d{10}$/', $this->username);
    }



    /**
     * 验证用户名
     *
     * @return void
     */
    public function validateUsername()
    {
        $username = $this->username;
        if(preg_match('/^1\d{10}$/', $username)) {
            return;
        }
        $emailValidator = new EmailValidator();
        if($emailValidator->validate($username, $error)) {
            return;
        }
        $this->addError('username', '用户名格式不正确');
    }




    /**
     * 获取 user
     *
     * @return Email|Mobile
     */
    public function getUser()
    {
        if (is_null($this->_user)) {
            if ($this->isMobile()) {
                $user = Mobile::findOne(['mobile' => $this->username]);
                if (!$user) {
                    $user = Mobile::create($this->username);
                }
            } else {
                $user = Email::findOne(['email' => $this->username]);
                if (!$user) {
                    $user = Email::create($this->username);
                }
            }
            $this->_user = $user;
        }
        return $this->_user;
    }



    /**
     * 保存 code 
     *
     * @return void
     */
    public function saveCode( $code , $duration = 1800 )
    {
        Yii::$app->session->set(self::CODE_SESSION_KEY, [
            'username' => $this->username,
            'code'     => $code,
            'expire'   => time() + $duration,
        ]);
    }



    /**
     * 清除 code
     *
     * @return void
     */
    public function clearCode()
    {
        Yii::$app->session->remove(self::CODE_SESSION_KEY);
    }



    /**
     * 获取保存的 code
     *
     * @return array|null
     */
    public function getSavedCode()
    {
        return Yii::$app->session->get(self::CODE_SESSION_KEY);
    }


    /**
     * 获取错误消息
     *
     * @return string
     */
    public function getErrorMessage()
    {
        $errors = $this->getFirstErrors();
        return reset($errors);
    }



}