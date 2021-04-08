<?php

use core\db\migrate\Migration;

/**
 * Handles the creation of table `{{%customer_account_email}}`.
 */
class m210408_143513_create_customer_account_email_table extends Migration
{

    public $table = '{{%customer_account_email}}';



    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->begin();
        $this->createTable($this->table, [
            'id'            => $this->primaryKey(),
            'customer_id'   => $this->fk()->unique()->comment('客户 ID'),
            'email'         => $this->string(64)->notNull()->unique()->comment('邮件地址'),
            'password_hash' => $this->string(64)->notNull()->comment('密码'),
            'is_verified'   => $this->boolean()->notNull()->defaultValue(0)->comment('是否已经验证'),
            'auth_key'      => $this->string()->notNull()->defaultValue('')->comment('认证 key'),
            'created_at'    => $this->dateTime()->notNull(),
            'updated_at'    => $this->dateTime()->notNull(),  
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
        $this->dropTable($this->table);
        $this->end();
    }
}
