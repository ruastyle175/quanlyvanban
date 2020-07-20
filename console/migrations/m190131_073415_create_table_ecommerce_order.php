<?php

use yii\db\Migration;

class m190131_073415_create_table_ecommerce_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'billing_name' => $this->string()->notNull(),
            'billing_phone' => $this->string()->notNull(),
            'billing_address' => $this->string()->notNull(),
            'billing_address_2' => $this->string(),
            'billing_email' => $this->string(),
            'billing_postcode' => $this->string(),
            'billing_city' => $this->string(),
            'billing_state' => $this->string(),
            'billing_country' => $this->string(),
            'shipping_name' => $this->string()->notNull(),
            'shipping_phone' => $this->string()->notNull(),
            'shipping_address' => $this->string()->notNull(),
            'shipping_address_2' => $this->string(),
            'shipping_email' => $this->string(),
            'shipping_postcode' => $this->string(),
            'shipping_city' => $this->string(),
            'shipping_state' => $this->string(),
            'shipping_country' => $this->string(),
            'payment_method' => $this->string(),
            'shipping_method' => $this->string(),
            'order_note' => $this->text(),
            'order_status' => $this->string()->notNull(),
            'order_total' => $this->float(),
            'order_shipping' => $this->float(),
            'order_tax' => $this->float(),
            'order_grand_total' => $this->float(),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_order}}');
    }
}
