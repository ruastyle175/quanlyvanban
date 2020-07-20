<?php

use yii\db\Migration;

class m190131_073527_create_table_ecommerce_version_option extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_version_option}}', [
            'id' => $this->primaryKey(),
            'product_version_id' => $this->integer()->notNull(),
            'option_id' => $this->integer()->notNull(),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_version_option}}');
    }
}
