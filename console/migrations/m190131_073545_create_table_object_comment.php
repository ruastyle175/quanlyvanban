<?php

use yii\db\Migration;

class m190131_073545_create_table_object_comment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_comment}}', [
            'id' => $this->bigPrimaryKey(),
            'object_id' => $this->string()->notNull(),
            'object_type' => $this->string()->notNull(),
            'parent_id' => $this->bigInteger(),
            'name' => $this->string(),
            'email' => $this->string(),
            'title' => $this->string(),
            'content' => $this->string(),
            'user_id' => $this->integer(),
            'user_type' => $this->string()->comment('data:app_user,user'),
            'user_role' => $this->string(),
            'like_count' => $this->integer(),
            'dislike_count' => $this->integer(),
            'share_count' => $this->integer(),
            'reply_count' => $this->integer(),
            'type' => $this->string()->comment('DROPDOWN:comment|reply'),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%object_comment}}');
    }
}