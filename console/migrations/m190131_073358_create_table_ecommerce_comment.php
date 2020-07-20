<?php

use yii\db\Migration;

class m190131_073358_create_table_ecommerce_comment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'object_id' => $this->integer()->notNull(),
            'object_type' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_comment}}');
    }
}
