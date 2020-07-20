<?php

use yii\db\Migration;

class m190131_073156_create_table_content_author extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_author}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cover' => $this->string(),
            'image' => $this->string(),
            'overview' => $this->string(),
            'content' => $this->text(),
            'dob' => $this->string(),
            'gender' => $this->string(),
            'type' => $this->string()->comment('DROPDOWN:author|writer|singer|composer|actor|director|teacher|translator'),
            'country' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'address' => $this->string(),
            'website' => $this->string(),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_author}}');
    }
}
