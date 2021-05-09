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
<?php $this->beginContent('@app/views/layouts/main.php') ?>
<div class="cus-center d-flex flex-nowrap">
    <div class="left-menu" style="width: 200px;">
        <ul>
            <li>用户中心</li>
            <li>用户中心</li>
            <li>用户中心</li>
            <li>用户中心</li>
            <li>用户中心</li>
            <li>用户中心</li>
            <li>用户中心</li>
            <li>用户中心</li>
            <li>用户中心</li>
        </ul>
    </div>
    <div class="right-content flex-grow-1">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent() ?>