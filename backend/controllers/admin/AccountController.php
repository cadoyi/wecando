<?php

namespace backend\controllers\admin;

use Yii;
use yii\web\Controller;


class AccountController extends Controller
{


    public function actionLogin()
    {
        return $this->render('login');
    }

}