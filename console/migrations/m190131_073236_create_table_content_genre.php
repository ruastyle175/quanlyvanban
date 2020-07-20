<?php

use yii\db\Migration;

class m190131_073236_create_table_content_genre extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_genre}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'type' => $this->string()->comment('DROPDOWN:book|movie|music'),
            'is_active' => $this->tinyInteger(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_genre}}');
    }
}
