<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 * @since 2.0.7
 * @deprecated since 2.0.8
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */
/* @var $table string the name table */
/* @var $field_first string the name field first */
/* @var $field_second string the name field second */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use core\db\migrate\Migration;

/**
 * Handles the creation of table `<?= $table ?>` which is a junction between
 * table `<?= $field_first ?>` and table `<?= $field_second ?>`.
 */
class <?= $className ?> extends Migration
{
    public $table = '<?= $table ?>';


    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->begin();
        $this->createTable($this->table, [
            '<?= $field_first ?>_id' => $this->integer(),
            '<?= $field_second ?>_id' => $this->integer(),
            'PRIMARY KEY(<?= $field_first ?>_id, <?= $field_second ?>_id)',
        ], $this->tableOptions);


        $this->addKey($this->table, '<?= $field_first ?>_id');
        $this->addKey($this->table, '<?= $field_second ?>_id');

        $this->addForeignKey(
            'fk-<?= $table . '-' . $field_first ?>_id',
            '<?= $table ?>',
            '<?= $field_first ?>_id',
            '<?= $field_first ?>',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-<?= $table . '-' . $field_second ?>_id',
            '<?= $table ?>',
            '<?= $field_second ?>_id',
            '<?= $field_second ?>',
            'id',
            'CASCADE'
        );
        $this->end();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->begin();
        $this->dropTable($this->table);
        $this->end();
    }
}
