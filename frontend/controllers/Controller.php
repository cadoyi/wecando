<?php

namespace frontend\controllers;

use Yii;

/**
 * 控制器基类
 * 
 * @property \yii\web\Request $request
 * @property \yii\web\User $user
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Controller extends \core\web\Controller
{



    /**
     * 获取请求对象
     *
     * @return \yii\web\Request
     */
    public function getRequest()
    {
        return Yii::$app->request;
    }



    /**
     * 获取 User 组件
     *
     * @return \yii\web\User
     */
    public function getUser()
    {
        return Yii::$app->user;
    }


}