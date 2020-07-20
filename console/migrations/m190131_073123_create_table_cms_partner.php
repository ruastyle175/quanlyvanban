<?php

use yii\db\Migration;

class m190131_073123_create_table_cms_partner extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_partner}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'facebook' => $this->string(),
            'google' => $this->string(),
            'skype' => $this->string(),
            'website' => $this->string(),
            'type' => $this->string(),
            'sort_order' => $this->integer(),
            'is_active' => $this->tinyInteger()->notNull(),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_partner}}');
    }
}
