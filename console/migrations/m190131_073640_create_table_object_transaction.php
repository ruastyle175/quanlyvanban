<?php

use yii\db\Migration;

class m190131_073640_create_table_object_transaction extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_transaction}}', [
            'id' => $this->primaryKey(),
            'transaction_id' => $this->string()->notNull(),
            'external_transaction_id' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull()->comment('LOOKUP:app_user|id|name'),
            'object_id' => $this->integer(),
            'object_type' => $this->string()->comment('DROPDOWN:order|user'),
            'currency' => $this->string()->comment('DROPDOWN:usd|vnd'),
            'amount' => $this->double()->defaultValue('0'),
            'payment_method' => $this->string()->comment('DROPDOWN:point|online'),
            'payment_gateway' => $this->string()->comment('DROPDOWN:paypal|system'),
            'note' => $this->string(),
            'time' => $this->string(),
            'type' => $this->string()->comment('DROPDOWN:buy|charge|deposit'),
            'status' => $this->string()->comment('DROPDOWN:fail|done|pending'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%object_transaction}}');
    }
}
