<?php

$modules = [];

$pattern = __DIR__ . '/*.php';
foreach (glob($pattern) as $filename) {
    $alias = pathinfo($filename, PATHINFO_FILENAME);
    if($alias === 'modules') {
        continue;
    }
    Yii::setAlias('@' . $alias, '@modules/' . $alias);
    $modules[$alias] = require $filename;
}
return $modules;