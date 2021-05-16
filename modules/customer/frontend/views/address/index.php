<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
/**
 * @var frontend\components\View $this
 * @var customer\models\User $customer
 */

$customer = Yii::$app->user->identity;
$addresses = $customer->addresses;
?>
<?php $this->beginBlock('content-head') ?>
<div class="info">地址管理</div>
<?php $this->endBlock() ?>
<div id="address_content" class="center-content">
    <?php if (empty($addresses)) : ?>
        <h4 class="text-muted">您还没有任何地址哦, 赶快添加一个吧!</h4>
    <?php else : ?>
        <?php foreach($addresses as $address): ?>
            <div class="card address-card mt-3">
                <div class="card-header py-2">
                    <label>
                        <input class="default-address-toggle"
                              type="radio" 
                              name="default-address" 
                              value="<?= $address->id ?>"
                            <?php if($address->isDefault()): ?>
                                checked
                            <?php endif; ?>
                        />
                        <i class="fa fa-circle-o"></i>
                        <span>默认地址</span>
                        <?php if(!empty($address->remark)): ?>
                            ( <?= Html::encode($address->remark) ?> )
                        <?php endif; ?>
                    </label>
                    <a class="edit" href="<?= Url::to(['/customer/address/update', 'id' => $address->id])?>">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a class="delete float-right" 
                       href="<?= Url::to(['/customer/address/delete', 'id' => $address->id]) ?>"
                       data-method="post"
                       data-confirm="确定要删除它吗? "
                    >
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div>
                        <?= Html::encode($address->username)?> 
                        <?= Html::encode($address->mobile) ?>
                    </div>
                    <div>
                        <?= Html::encode($address->province) ?>
                        <?= Html::encode($address->city) ?>
                        <?= Html::encode($address->distinct)?>
                        <?= Html::encode($address->street) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="buttons border-top py-3 mt-3">
        <a class="btn btn-sm btn-success rounded-0" href="<?= Url::to(['/customer/address/create'])?>">新增地址</a>
    </div>
</div>
<?php $this->beginScript() ?>
<script>
    $('.default-address-toggle').on('change', function( e ) {
        var url = '/customer/address/toggle-default.html?id=' + $(this).val();
        $.post(url).then(function( res ) {
            if(res.code == '0') {
                cado.message.success('操作成功');
            } else {
                cado.message.error(res.message);
            } 
        });
    });
</script>
<?php $this->endScript() ?>