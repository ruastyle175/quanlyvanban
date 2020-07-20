<?php

use yii\db\Migration;

class m190131_073026_create_table_app_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%app_user}}', [
            'id' => $this->primaryKey(),
            'avatar' => $this->string(),
            'name' => $this->string()->notNull(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'auth_id' => $this->integer()->defaultValue('0'),
            'auth_key' => $this->string(),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'gender' => $this->string()->comment('DROPDOWN:male|female|other'),
            'dob' => $this->string(),
            'phone' => $this->string(),
            'weight' => $this->string(),
            'height' => $this->string(),
            'address' => $this->string(),
            'country' => $this->string(),
            'state' => $this->string(),
            'city' => $this->string(),
            'lat' => $this->string(),
            'long' => $this->string(),
            'balance' => $this->decimal(),
            'role' => $this->integer(),
            'rate' => $this->float()->defaultValue('0'),
            'rate_count' => $this->integer()->defaultValue('0'),
            'type' => $this->string(),
            'status' => $this->string(),
            'is_online' => $this->tinyInteger()->defaultValue('0'),
            'is_active' => $this->tinyInteger()->defaultValue('1'),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

        $this->createIndex('email', '{{%app_user}}', 'email', true);
        $this->createIndex('password_reset_token', '{{%app_user}}', 'password_reset_token', true);
        $this->createIndex('username', '{{%app_user}}', 'username', true);
    }

    public function down()
    {
        $this->dropTable('{{%app_user}}');
    }
}
