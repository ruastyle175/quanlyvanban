<?php

use yii\db\Migration;

class m190131_073216_create_table_content_course extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_course}}', [
            'id' => $this->primaryKey(),
            'content_id' => $this->integer(),
            'teacher' => $this->string(),
            'start_date' => $this->string(),
            'end_date' => $this->string(),
            'duration' => $this->string(),
            'lesson_count' => $this->string(),
            'size' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_course}}');
    }
}
