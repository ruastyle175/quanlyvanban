<?php

use yii\db\Migration;

class m190131_073349_create_table_ecommerce_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue('0'),
            'image' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'sort_order' => $this->integer(),
            'is_active' => $this->tinyInteger()->notNull(),
            'object_type' => $this->string()->notNull()->comment('DROPDOWN:blog|product|book'),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_category}}');
    }
}
