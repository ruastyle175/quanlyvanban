<?php

use yii\db\Migration;

class m190131_073148_create_table_content extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'cover' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'rate' => $this->float()->defaultValue('0'),
            'rate_count' => $this->integer()->defaultValue('0'),
            'view_count' => $this->integer()->defaultValue('0'),
            'like_count' => $this->integer()->defaultValue('0'),
            'share_count' => $this->integer(),
            'type' => $this->string()->comment('DROPDOWN:book|music|movie|course'),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content}}');
    }
}
