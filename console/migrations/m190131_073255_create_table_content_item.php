<?php

use yii\db\Migration;

class m190131_073255_create_table_content_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_item}}', [
            'id' => $this->primaryKey(),
            'content_id' => $this->integer()->notNull()->comment('FOREIGN KEY (bookId) REFERENCES book(id)'),
            'image' => $this->string(),
            'attachment' => $this->string(),
            'title' => $this->string()->notNull(),
            'number' => $this->integer(),
            'description' => $this->string(),
            'content' => $this->text(),
            'rate' => $this->integer(),
            'rate_count' => $this->integer(),
            'view_count' => $this->integer(),
            'like_count' => $this->integer(),
            'share_count' => $this->string(),
            'sale_count' => $this->integer(),
            'comment_count' => $this->integer(),
            'sort_order' => $this->integer(),
            'type' => $this->string()->comment('DROPDOWN:chapter|episode|lesson'),
            'status' => $this->string()->comment('DROPDOWN:pending|rejected|approved'),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_item}}');
    }
}
