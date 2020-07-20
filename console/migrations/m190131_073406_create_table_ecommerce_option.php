<?php

use yii\db\Migration;

class m190131_073406_create_table_ecommerce_option extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_option}}', [
            'id' => $this->primaryKey(),
            'attribute_id' => $this->integer()->notNull(),
            'attribute' => $this->string()->notNull(),
            'option' => $this->string()->notNull(),
            'image' => $this->string(),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_option}}');
    }
}
