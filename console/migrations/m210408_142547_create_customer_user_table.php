<?php

use core\db\migrate\Migration;

/**
 * Handles the creation of table `{{%customer_user}}`.
 */
class m210408_142547_create_customer_user_table extends Migration
{

    public $table = '{{%customer_user}}';



    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->begin();
        $this->createTable($this->table, [
            'id'         => $this->primaryKey(),
            'nickname'   => $this->string(64)->notNull()->defaultValue('')->comment('昵称'),
            'avatar'     => $this->string(255)->notNull()->defaultValue('')->comment('头像'),
            'sex'        => $this->boolean()->notNull()->defaultValue(0)->comment('性别: 0: 未知,1: 女, 2:男'),
            'status'     => $this->boolean()->notNull()->defaultValue(1)->comment('状态,1:激活,2:冻结'),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $this->tableOptions);

        $this->addKey($this->table, 'created_at');
        $this->end();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->begin();
        $this->dropKey($this->table, 'created_at');
        $this->dropTable($this->table);
        $this->end();
    }
}
