<?php

use yii\db\Migration;

class m190131_073427_create_table_ecommerce_order_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'note' => $this->string(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->float()->notNull(),
            'total' => $this->float()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_order_item}}');
    }
}
