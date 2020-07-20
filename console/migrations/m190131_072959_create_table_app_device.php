<?php

use yii\db\Migration;

class m190131_072959_create_table_app_device extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%app_device}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment('LOOKUP:app_user|id|name'),
            'imei' => $this->string()->notNull(),
            'token' => $this->string()->notNull(),
            'type' => $this->string()->notNull()->comment('DROPDOWN:android|ios'),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%app_device}}');
    }
}
