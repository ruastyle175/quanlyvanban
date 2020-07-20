<?php

use yii\db\Migration;

class m190131_073321_create_table_content_music extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_music}}', [
            'id' => $this->primaryKey(),
            'content_id' => $this->integer(),
            'publisher' => $this->string(),
            'publication' => $this->string(),
            'manufacturer' => $this->string(),
            'singer' => $this->string(),
            'composer' => $this->string(),
            'writer' => $this->string(),
            'mood' => $this->string(),
            'genre' => $this->string(),
            'demo' => $this->string(),
            'attachment' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_music}}');
    }
}
