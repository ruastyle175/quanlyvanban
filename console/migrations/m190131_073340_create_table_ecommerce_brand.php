<?php

use yii\db\Migration;

class m190131_073340_create_table_ecommerce_brand extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_brand}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'established' => $this->string(),
            'country' => $this->string(),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_brand}}');
    }
}
