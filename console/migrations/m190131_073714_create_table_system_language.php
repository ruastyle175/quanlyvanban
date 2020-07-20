<?php

use yii\db\Migration;

class m190131_073714_create_table_system_language extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%system_language}}', [
            'id' => $this->primaryKey(),
            'language_code' => $this->string()->notNull(),
            'language_name' => $this->string()->notNull(),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%system_language}}');
    }
}
