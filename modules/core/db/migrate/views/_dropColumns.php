<?php

echo  $this->render('_dropForeignKeys', [
    'foreignKeys' => $foreignKeys,
]);

foreach ($fields as $field): ?>
        $this->dropColumn($this->table, '<?= $field['property'] ?>');
<?php endforeach;
