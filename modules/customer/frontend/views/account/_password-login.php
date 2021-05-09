<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
/**
 * 密码登录
 * 
 */
?>
<?= Html::beginForm(['login-password'], 'post', [
    'id' => 'password_login_form',
]) ?>
<div class="form-group">
    密码登录
</div>
<div class="form-group mb-4">
    <input type="text" class="form-control" name="username" placeholder="手机号/邮箱" />

</div>
<div class="form-group mb-4">
    <input type="password" class="form-control" name="password" placeholder="请输入密码" />
</div>
<div class="form-group mt-4 mb-0">
    <?= Html::submitButton('登录', [
        'class' => 'btn btn-primary btn-block'
    ]) ?>
</div>
<div class="form-group text-right">
    <a style="font-size: .7rem;" href="#">忘记密码</a>
    <a style="font-size: .7rem;" href="#">免费注册</a>
</div>
<?= Html::endForm(); ?>
<?php $this->beginScript() ?>
<script>
    $('#password_login_form').on('submit', function(e) {
        stopEvent(e);
        var form = $(this);
        var url = form.attr('action');
        var data = form.serializeArray();
        $.post(url, data).then(function(res) {
            if (res.code == 0) {
                cado.message.success('登录成功').then(function() {
                    location.reload();
                });
                return;
            }
            cado.message.error(res.message).then(function(res) {
                console.log(res);
            });
        });
    });
</script>
<?php $this->endScript() ?>