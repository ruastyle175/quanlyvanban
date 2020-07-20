<?php

use yii\db\Migration;

class m190131_073102_create_table_cms_employee extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_employee}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'position' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'facebook' => $this->string(),
            'google' => $this->string(),
            'twitter' => $this->string(),
            'skype' => $this->string(),
            'type' => $this->string()->comment('DROPDOWN:full_time|part_time'),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_employee}}');
    }
}
