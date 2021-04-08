<?php

namespace frontend\controllers\customer;

use Yii;
use frontend\controllers\Controller;


/**
 * 账户控制器
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AccountController extends Controller
{


    /**
     * 注销登录
     *
     * @return void
     */
    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        return $this->goHome();
    }




    /**
     * 使用 ajax 登出
     *
     * @return void
     */
    public function actionLogoutAjax()
    {
        if(!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        return $this->_success();
    }



    /**
     * 登录界面
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


}
