<?php

use yii\db\Migration;

class m190131_073313_create_table_content_movie extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_movie}}', [
            'id' => $this->primaryKey(),
            'content_id' => $this->integer(),
            'manufacturer' => $this->string(),
            'publisher' => $this->string(),
            'publication' => $this->string(),
            'genre' => $this->string(),
            'director' => $this->string(),
            'writer' => $this->string(),
            'cast' => $this->string(),
            'duration' => $this->string(),
            'resolution' => $this->string(),
            'quality' => $this->string(),
            'imdb_rating' => $this->string(),
            'imdb_link' => $this->string(),
            'label' => $this->string(),
            'country' => $this->string(),
            'subtitle' => $this->string(),
            'episode_total' => $this->string(),
            'episode_current' => $this->string(),
            'episode_count' => $this->string(),
            'trailer' => $this->string(),
            'attachment' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_movie}}');
    }
}
