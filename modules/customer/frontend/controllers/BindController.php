<?php

namespace customer\frontend\controllers;

use frontend\controllers\Controller;
use Yii;

/**
 * 账号绑定操作
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class BindController extends Controller
{
    public $layout = '@customer/frontend/views/layouts/center';


    /**
     * 绑定操作列表
     *
     * @return void
     */
    public function actionIndex()
    {
        return $this->renderContent('渲染绑定操作');
    }

    

}