<?php

namespace backend\controllers;

use Yii;
use core\web\Controller as CoreController;

/**
 * 控制器基类
 *
 * @property \yii\web\Request $request
 * @property \yii\web\User $user
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Controller extends CoreController
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
     * 获取 user 组件
     *
     * @return \yii\web\User
     */
    public function getUser()
    {
        return Yii::$app->user;
    }




}