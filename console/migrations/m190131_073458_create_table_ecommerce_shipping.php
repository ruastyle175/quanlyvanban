<?php

use yii\db\Migration;

class m190131_073458_create_table_ecommerce_shipping extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ecommerce_shipping}}', [
            'id' => $this->primaryKey(),
            'postcode' => $this->string()->notNull()->defaultValue(''),
            'min_value' => $this->double()->notNull(),
            'max_value' => $this->double()->notNull(),
            'cost' => $this->double()->notNull(),
            'type' => $this->string()->notNull()->comment('dropdown:{weight,total}'),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->string()->notNull(),
            'modified_date' => $this->string()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ecommerce_shipping}}');
    }
}
