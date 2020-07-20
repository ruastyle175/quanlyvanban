<?php

use yii\db\Migration;

class m190131_072908_create_table_app_auth extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%app_auth}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('LOOKUP:app_user|id|name'),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
            'name' => $this->string(),
            'image' => $this->string(),
        ], $tableOptions);

        $this->createIndex('fk-auth-user_id-user-id', '{{%app_auth}}', 'user_id');
    }

    public function down()
    {
        $this->dropTable('{{%app_auth}}');
    }
}
