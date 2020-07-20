<?php

use yii\db\Migration;

class m190131_073553_create_table_object_counter extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_counter}}', [
            'id' => $this->primaryKey(),
            'object_id' => $this->integer()->notNull(),
            'object_type' => $this->string()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue('0'),
            'attribute' => $this->string()->notNull(),
            'date' => $this->string(),
            'week' => $this->string(),
            'month' => $this->string(),
            'year' => $this->string()->notNull(),
            'focus' => $this->string()->notNull()->comment('date/week/month/year'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%object_counter}}');
    }
}
