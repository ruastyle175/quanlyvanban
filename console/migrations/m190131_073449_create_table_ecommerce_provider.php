<?php

use yii\db\Migration;

class m190131_073449_create_table_ecommerce_provider extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_provider}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'code' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'established' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'address' => $this->string(),
            'city' => $this->string(),
            'country' => $this->string(),
            'website' => $this->string(),
            'lat' => $this->float(),
            'long' => $this->float(),
            'type' => $this->string(),
            'status' => $this->string(),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_provider}}');
    }
}
