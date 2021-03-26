<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */
/* @var $table string the name table */
/* @var $fields array the fields */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use core\db\migrate\Migration;

/**
 * Handles dropping columns from table `<?= $table ?>`.
<?= $this->render('_foreignTables', [
    'foreignKeys' => $foreignKeys,
]) ?>
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
<?= $this->render('_dropColumns', [
    'table' => $table,
    'fields' => $fields,
    'foreignKeys' => $foreignKeys,
])
?>
        $this->end();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->begin();
<?= $this->render('_addColumns', [
    'table' => $table,
    'fields' => $fields,
    'foreignKeys' => $foreignKeys,
])
?>
        $this->end();
    }
}
