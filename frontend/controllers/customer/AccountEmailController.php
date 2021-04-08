<?php

namespace frontend\controllers\customer;

use Yii;
use frontend\controllers\Controller;
use frontend\models\customer\EmailLoginForm;

/**
 * 邮件账户控制器
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class AccountEmailController extends Controller
{


    /**
     * 登录操作
     *
     * @return void
     */
    public function actionLogin()
    {
        $model = new EmailLoginForm();
        
        if($model->load($this->request->post(), '') && $model->login()) {
            return $this->_success();
        }
        return $this->_error([1013, '字段验证错误'], $model->getFirstErrors());
    }

    


}