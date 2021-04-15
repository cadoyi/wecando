<?php

use core\db\migrate\Migration;

/**
 * Handles the creation of table `{{%weixin_qrcode_permanent}}`.
 */
class m210409_013551_create_weixin_qrcode_permanent_table extends Migration
{

    public $table = '{{%weixin_qrcode_permanent}}';



    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->begin();
        $this->createTable($this->table, [
            'id'          => $this->primaryKey(),
            'type'        => $this->string(32)->notNull()->comment('场景值类型'),
            'qrscene'     => $this->string(64)->notNull()->defaultValue('')->comment('场景值'),
            'description' => $this->string(255)->notNull()->defaultValue('')->comment('二维码描述'),
            'ticket'      => $this->string()->notNull()->defaultValue('')->comment('换取二维码的票据'),
            'generate_at' => $this->dateTime()->comment('生成时间'),
            'created_at'  => $this->dateTime()->notNull(),
            'updated_at'  => $this->dateTime()->notNull(),
        ], $this->tableOptions);
        $this->addKey($this->table, 'ticket');
        $this->addKey($this->table, 'qrscene');
        $this->addKey($this->table, ['generate_at', 'ticket']);
        $this->addKey($this->table, 'description');
        $this->end();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->begin();
        $this->dropKey($this->table, 'ticket');
        $this->dropKey($this->table, 'qrscene');
        $this->dropKey($this->table, ['generate_at', 'ticket']);
        $this->dropKey($this->table, 'description');
        $this->dropTable($this->table);
        $this->end();
    }
}
