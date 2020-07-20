<?php

use yii\db\Migration;

class m190131_073207_create_table_content_book extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_book}}', [
            'id' => $this->primaryKey(),
            'content_id' => $this->integer(),
            'publisher' => $this->string(),
            'republish' => $this->string(),
            'publication' => $this->string(),
            'manufacturer' => $this->string(),
            'author' => $this->string(),
            'translator' => $this->string(),
            'reader' => $this->string(),
            'page_count' => $this->integer(),
            'book_cover' => $this->string(),
            'size' => $this->string(),
            'chapter_total' => $this->string(),
            'chapter_current' => $this->string(),
            'chapter_count' => $this->string(),
            'demo' => $this->string(),
            'attachment' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_book}}');
    }
}
