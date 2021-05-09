<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<header class="header shadow-sm">
    <nav class="navbar navbar-expand navbar-light bg-white">
        <a class="navbar-brand" href="#">Wecando</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= Yii::$app->homeUrl ?>">首页</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">我的订单</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">我的足迹</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">我的购物车</a>
                </li>
            </ul>
            <ul class="navbar-nav  ml-auto">
                <?php if (Yii::$app->user->isGuest) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/customer/account/login']) ?>">注册/登录</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= Html::encode(Yii::$app->user->identity->nickname) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="<?= Url::to(['/customer/center/index']) ?>"><i class="fa fa-user"></i> 用户中心</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-heart"></i> 我的足迹</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-cart-plus"></i> 我的订单</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-star"></i> 我的收藏</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger text-center" data-method="post" data-confirm="确定要注销登录吗?" href="<?= Url::to(['/customer/account/logout']) ?>">退出登录</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>