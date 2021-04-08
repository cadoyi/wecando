<?php

namespace console\controllers\admin;

use Yii;
use yii\console\Controller;

class AccountController extends Controller
{

    public function actionLogin()
    {
        return $this->stdout('Complete ok');
    }
}