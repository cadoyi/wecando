<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<footer class="footer shadow-lg">
    <div class="d-flex flex-nowrap link-bar m-0">
        <div class="col">
            <div title>新手上路</div>
            <ul>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
            </ul>
        </div>
        <div class="col">
            <div title>售后保障</div>
            <ul>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
            </ul>
        </div>
        <div class="col">
            <div title>网站特色</div>
            <ul>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
                <li><a href="#">二级菜单</a></li>
            </ul>
        </div>
        <div class="col">
            <div title>联系我们</div>
            <div class="qrcodes d-flex justify-content-begin flex-nowrap">
                <div class="contact d-flex flex-column align-items-center">
                    <img width="90" src="" />
                    <div>关注我们</div>

                </div>
                <div class="focus d-flex flex-column align-items-center">
                    <img width="90" src="" />
                    <div>联系我们</div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-bar d-flex justify-content-center">
        <span class="mr-1">&copy; 2016-<?= date('Y') ?> <?= '我的网站' ?> 版权所有</span>
        <a class="text-dark" href="https://beian.miit.gov.cn/">京ICP备111222333号</a>
    </div>
</footer>