<?php

use yii\db\Migration;

class m190131_073700_create_table_system_country extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%system_country}}', [
            'id' => $this->primaryKey(),
            'country_code' => $this->string()->notNull()->defaultValue(''),
            'country_name' => $this->string()->notNull()->defaultValue(''),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%system_country}}');
    }
}
