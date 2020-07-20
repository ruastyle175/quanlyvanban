<?php

use yii\db\Migration;

class m190131_073140_create_table_cms_testimonial extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_testimonial}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->string(),
            'location' => $this->string(),
            'sort_order' => $this->integer(),
            'type' => $this->string(),
            'is_active' => $this->string()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_testimonial}}');
    }
}
