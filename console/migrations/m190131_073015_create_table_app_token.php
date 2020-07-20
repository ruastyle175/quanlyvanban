<?php

use yii\db\Migration;

class m190131_073015_create_table_app_token extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%app_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('LOOKUP:app_user|id|name'),
            'token' => $this->string(),
            'time' => $this->string(),
            'is_expired' => $this->tinyInteger(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%app_token}}');
    }
}
