<?php

use yii\db\Migration;

class m190131_073054_create_table_blog_post extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'image' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'type' => $this->string()->comment('DROPDOWN:gaming|technology|misc'),
            'is_featured' => $this->tinyInteger()->notNull(),
            'is_active' => $this->tinyInteger()->notNull(),
            'user_id' => $this->integer(),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%blog_post}}');
    }
}
