<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\CustomerAsset;

CustomerAsset::register($this);
?>
<?php
/**
 * 
 * 
 */
?>
<div class="login-wrap">

    <div class="card form-container">
        <div class="card-head">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#password_login" role="tab" aria-controls="password_login" aria-selected="true">
                        密码登录
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#captcha_login" role="tab" aria-controls="captcha_login" aria-selected="false">
                        验证码登录
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div id="password_login" class="tab-pane fade active show">
                <?= $this->render('_password-login') ?>
            </div>
            <div id="captcha_login" class="tab-pane fade">
                <?= $this->render('_captcha-login') ?>
            </div>
        </div>
        <div class="card-footer third-login-method">
            <span>其他登录方式: </span>
            <a href="<?= Url::to(['/customer/account/wechat-login']) ?>">
                <i class="fa fa-wechat"></i>
            </a>
        </div>
    </div>

</div>