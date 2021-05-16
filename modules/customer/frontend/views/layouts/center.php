<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use frontend\assets\CustomerAsset;

CustomerAsset::register($this);
?>
<?php
/**
 * @var \frontend\components\View $this
 * 
 */
?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>
<div class="cus-center d-flex flex-nowrap">
    <div class="card left-menu" style="width: 200px;">
        <div class="card-header text-center">
            用户中心
        </div>
        <div class="card-body">
            <?= Menu::widget([
                'items' => [
                    [
                        'url' => ['/customer/center/index'],
                        'label' => '基本信息',
                    ],
                    [
                        'url' => ['/customer/address/index'],
                        'label' => '地址管理',
                    ],
                    [
                        'url' => '#',
                        'label' => '我的收藏',
                    ],
                    [
                        'url' => '#',
                        'label' => '我的关注',
                    ],
                    [
                        'url' => '#',
                        'label' => '我的积分',
                    ],
                    [
                        'url' => ['/customer/bind/index'],
                        'label' => '账号绑定',
                    ],
                    [
                        'url' => '#',
                        'label' => '我的足迹',
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <div class="right-content flex-grow-1">
        <div class="card center-index rounded-0">
            <div class="card-header">
            <?php if(isset($this->blocks['content-head'])): ?>
                <?= $this->blocks['content-head'] ?>
            <?php else: ?>
                输入标题
            <?php endif; ?>
            </div>
            <div class="card-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent() ?>