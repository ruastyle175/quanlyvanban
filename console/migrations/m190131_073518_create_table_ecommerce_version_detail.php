<?php

use yii\db\Migration;

class m190131_073518_create_table_ecommerce_version_detail extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_version_detail}}', [
            'id' => $this->primaryKey(),
            'product_version_id' => $this->integer()->notNull()->comment('lookup:@product_version'),
            'attribute_id' => $this->integer(),
            'option_id' => $this->integer()->notNull()->comment('lookup:@product_option'),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_version_detail}}');
    }
}
