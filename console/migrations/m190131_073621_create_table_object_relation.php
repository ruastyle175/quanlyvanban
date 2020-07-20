<?php

use yii\db\Migration;

class m190131_073621_create_table_object_relation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_relation}}', [
            'id' => $this->bigPrimaryKey(),
            'object_id' => $this->bigInteger()->notNull(),
            'object_type' => $this->string()->notNull(),
            'object2_id' => $this->bigInteger()->notNull(),
            'object2_type' => $this->string()->notNull(),
            'relation_type' => $this->string(),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%object_relation}}');
    }
}
