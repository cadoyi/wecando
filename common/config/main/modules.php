<?php

$modules = [];

$pattern = __DIR__ . '/modules/*.php';
foreach (glob($pattern) as $filename) {
    $alias = pathinfo($filename, PATHINFO_FILENAME);
    Yii::setAlias('@' . $alias, '@modules/' . $alias);
    $modules[$alias] = require $filename;
}
return $modules;