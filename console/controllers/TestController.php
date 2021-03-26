<?php

namespace console\controllers;

use Yii;

class TestController extends \yii\console\Controller
{


    public function actionTest()
    {
        Yii::$app->logger->log('admin_visit', [
            'action' => 'admin/account/login',
            'remark' => '用户登录',
        ]);
    }
}