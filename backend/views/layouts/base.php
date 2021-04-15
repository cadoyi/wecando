<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\LayoutAsset;

LayoutAsset::register($this);
?>
<?php
/**
 * @var yii\web\View $this
 */
?>
<?= $this->beginPage()?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>原始布局</title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>
     <?= $content ?>
</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>