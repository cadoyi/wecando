<?php

namespace customer\frontend\controllers;

use Yii;
use frontend\controllers\Controller;

/**
 * 用户中心
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class CenterController extends Controller
{

    public $layout = '@customer/frontend/views/layouts/center';


    /**
     * 客户中心
     * 
     * @return void
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}