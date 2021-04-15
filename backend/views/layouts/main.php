<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
/**
 * @var yii\web\View $this
 */
?>
<?php $this->beginContent(__DIR__ . '/base.php'); ?>
<div class="layui-layout layui-layout-admin">
    <?= $this->render('main/header') ?>
    <?= $this->render('main/sidebar') ?>
    <div class="body-content">
        <div class="breadcrumb">
            <span class="layui-breadcrumb" style="visibility: visible;">
                <a href="/">首页</a><span lay-separator="">/</span>
                <a href="/demo/">演示</a><span lay-separator="">/</span>
                <a><cite>导航元素</cite></a>
            </span>
        </div>
        <?= $content ?>
    </div>
</div>
<?php $this->endContent();  ?>