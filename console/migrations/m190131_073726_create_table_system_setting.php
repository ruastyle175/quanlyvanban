<?php

use yii\db\Migration;

class m190131_073726_create_table_system_setting extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%system_setting}}', [
            'id' => $this->primaryKey(),
            'setting_key' => $this->string(),
            'setting_value' => $this->text(),
            'type' => $this->string()->comment('DROPDOWN:application|layout'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%system_setting}}');
    }
}
