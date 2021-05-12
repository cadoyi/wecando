<?php

namespace customer\frontend\controllers;

use frontend\controllers\Controller;
use Yii;
use customer\frontend\models\PasswordLoginForm;
use customer\frontend\models\SendCodeForm;
use customer\frontend\models\CaptchaLoginForm;

/**
 * 账户控制器
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AccountController extends Controller
{



    /**
     * 登录操作
     *
     * @return void
     */
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('login');
    }


    /**
     * 登出操作
     *
     * @return void
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }




    /**
     * 密码登录方式
     * 
     * @return void
     */
    public function actionLoginPassword()
    {
        $model = new PasswordLoginForm();
        if($model->load($this->request->post(), '') && $model->login()) {
            return $this->_success();
        }
        return $this->_error([1, $model->getErrorMessage()]);
    }




    /**
     * 验证码登录方式
     * 
     * @return void
     */
    public function actionLoginCaptcha()
    {
        $model = new CaptchaLoginForm();
        
        if($model->load($this->request->post(), '') && $model->login()) {
            return $this->_success();
        }
        $error = $model->getErrorMessage();
        return $this->_error([1, $error]);
    }



    /**
     * 发送验证码
     *
     * @return void
     */
    public function actionSendCode()
    {
        $username = $this->request->post('username');
        $model = new SendCodeForm(['username' => $username]);
        if(!$model->sendCode()) {
            $error = $model->getErrorMessage();
            return $this->_error([1, $error]);
        }
        return $this->_success();
    }



    /**
     * 微信登录
     *
     * @return void
     */
    public function actionWechatLogin()
    {

    }



    /**
     * 微信登录回调
     *
     * @return void
     */
    public function actionWechatLoginCallback()
    {

    }

}