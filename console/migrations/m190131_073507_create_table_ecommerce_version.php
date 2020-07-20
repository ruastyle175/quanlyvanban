<?php

use yii\db\Migration;

class m190131_073507_create_table_ecommerce_version extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_version}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'name' => $this->string()->notNull(),
            'price' => $this->double(),
            'product_id' => $this->integer()->notNull(),
            'sort_order' => $this->integer()->defaultValue('0'),
            'is_active' => $this->tinyInteger()->notNull()->defaultValue('1'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_version}}');
    }
}
