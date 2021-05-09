<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\LayoutAsset;
use common\widgets\Alert;

LayoutAsset::register($this);
?>
<?php $this->beginContent(__DIR__ . '/base.php') ?>
<?= $this->render('main/header') ?>
<main class="body-container">
    <div class="container-fluid px-0">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?= $this->render('main/footer') ?> 
<?php $this->endContent() ?>