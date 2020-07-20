<?php

use yii\db\Migration;

class m190131_073652_create_table_system_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%system_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue('0'),
            'image' => $this->string(),
            'banner' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'content' => $this->string(),
            'color' => $this->string(),
            'sort_order' => $this->integer()->defaultValue('0'),
            'type' => $this->string()->notNull()->comment('DROPDOWN:category|genre|mood|group|tag'),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%system_category}}');
    }
}
