<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
?>
<?php
/**
 * @var frontend\components\View $this 
 * @var customer\models\User $customer
 * @var customer\models\Address $address
 * 
 */
$customer = Yii::$app->user->identity;
?>
<?php $this->beginBlock('content-head') ?>
<div class="info"><a href="<?= Url::to(['/customer/address/index']) ?>" >地址管理</a> / 编辑管理</div>
<?php $this->endBlock() ?>

<?php $form = ActiveForm::begin([
    'id' => 'edit_address_form',
    'action' => Url::to(['/customer/address/save']),
    'options' => [
        
    ]
]) ?>
    <?php if(!$address->isNewRecord): ?>
        <?= $form->field($address, 'id')->hiddenInput(['name' => 'id'])->label(false) ?>
    <?php endif; ?>
    <?= $form->field($address, 'remark') ?>
    <?= $form->field($address, 'username') ?>
    <?= $form->field($address, 'mobile') ?>
    <?= $form->field($address, 'province') ?>
    <?= $form->field($address, 'city') ?>
    <?= $form->field($address, 'distinct') ?>
    <?= $form->field($address, 'street')->textarea() ?>
    <?= Html::submitButton('保存', [
        'class' => 'btn btn-sm btn-outline-primary',
    ]) ?>
<?php ActiveForm::end() ?>
<?php $this->beginScript()?>
   <script>
       $('#edit_address_form').on('beforeSubmit', function( e ) {
           e.preventDefault();
           var form = $(this),
           url = form.attr('action'),
           data = form.serializeArray();
           $.post(url, data).then(function( res ) {
              if(res.code == 0) {
                  cado.message.success('保存地址成功').then(function() {
                      history.go(-1);
                  });
              } else {
                 cado.message.error(res.message);
              }
           });
           return false;
       });
   </script>

<?php $this->endScript() ?>