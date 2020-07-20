<?php

use yii\db\Migration;

class m190131_073612_create_table_object_file extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_file}}', [
            'id' => $this->primaryKey(),
            'object_id' => $this->integer()->notNull(),
            'object_type' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'file_name' => $this->string()->notNull(),
            'file_type' => $this->string()->notNull()->comment('DROPDOWN:video|image|audio|misc'),
            'file_size' => $this->string(),
            'file_duration' => $this->string(),
            'sort_order' => $this->integer(),
            'is_active' => $this->tinyInteger(),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%object_file}}');
    }
}
