<?php

use yii\db\Migration;

class m190131_073330_create_table_ecommerce_attribute extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_attribute}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'attribute' => $this->string()->notNull(),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_attribute}}');
    }
}
