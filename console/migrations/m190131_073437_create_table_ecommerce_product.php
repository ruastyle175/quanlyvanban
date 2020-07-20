<?php

use yii\db\Migration;

class m190131_073437_create_table_ecommerce_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_product}}', [
            'id' => $this->bigPrimaryKey(),
            'object_id' => $this->integer(),
            'object_type' => $this->string(),
            'image' => $this->string(),
            'cover' => $this->string(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'overview' => $this->string(),
            'content' => $this->text(),
            'price' => $this->decimal(),
            'discount_percent' => $this->decimal()->defaultValue('0'),
            'discount_amount' => $this->decimal()->defaultValue('0'),
            'sale_price' => $this->decimal(),
            'currency' => $this->string()->comment('DROPDOWN:VND|USD|EUR'),
            'unit' => $this->string(),
            'brand_id' => $this->integer()->comment('LOOKUP:ecommerce_brand|id|name'),
            'origin' => $this->string()->comment('LOOKUP:utility_country|country_code|country_name'),
            'rate' => $this->float()->defaultValue('0'),
            'rate_count' => $this->integer()->defaultValue('0'),
            'view_count' => $this->integer()->defaultValue('0'),
            'sale_count' => $this->integer()->defaultValue('0'),
            'like_count' => $this->integer()->defaultValue('0'),
            'in_stock' => $this->tinyInteger()->notNull()->defaultValue('1'),
            'is_featured' => $this->tinyInteger()->notNull()->defaultValue('0'),
            'is_active' => $this->tinyInteger()->notNull()->defaultValue('1'),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_product}}');
    }
}
