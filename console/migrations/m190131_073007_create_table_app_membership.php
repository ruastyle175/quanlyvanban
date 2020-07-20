<?php

use yii\db\Migration;

class m190131_073007_create_table_app_membership extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%app_membership}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'service' => $this->string()->comment('data:business,library,ecommerce,content'),
            'type' => $this->string()->notNull()->comment('data:vip,premium,pro'),
            'expiry' => $this->integer()->notNull(),
            'is_active' => $this->tinyInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%app_membership}}');
    }
}
