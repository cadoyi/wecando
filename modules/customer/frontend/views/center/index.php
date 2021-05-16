<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
/**
 * 
 * 
 */
?>
<?php $this->beginBlock('content-head') ?>
<div class="info">基本信息</div>
<?php $this->endBlock() ?>
<div class="card center-index rounded-0">
    <div class="card-body d-flex flex-nowrap">
        <a class="avatar-link text-center" href="#">
            <img alt="" src="<?= Url::to('@web/img/customer/default_handsome.jpg') ?>" />
            <div class="edit-avatar">修改头像</div>
        </a>
        <div class="flex-grow-1 px-3">
            <table class="table cus-table-info">
                <colgroup>
                <col style="width: 7rem;" />
                <col />
                </colgroup>
                <tr>
                    <td>我的昵称</td>
                    <td>zhangyang</td>
                </tr>
                <tr>
                    <td>我的身份</td>
                    <td>钻石会员 (距离下一级剩余: 500 经验值)</td>
                </tr>
                <tr>
                    <td>注册日期</td>
                    <td>2021-01-01 00:00:00</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="progress">
                            <div class="progress-bar" style="width: 15%;">
                            85% 钻石会员
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="card center-index rounded-0 mt-2">
    <div class="card-body">
        内容
    </div>
</div>