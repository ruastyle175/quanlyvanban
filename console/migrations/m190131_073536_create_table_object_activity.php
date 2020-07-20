<?php

use yii\db\Migration;

class m190131_073536_create_table_object_activity extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_activity}}', [
            'id' => $this->primaryKey(),
            'object_id' => $this->string()->notNull(),
            'object_type' => $this->string()->notNull(),
            'type' => $this->string()->notNull()->comment('data:like,share,favourite,rate'),
            'user_id' => $this->integer()->notNull()->comment('lookup:@app_user'),
            'user_type' => $this->string()->comment('data:app_user,user'),
            'created_date' => $this->dateTime(),
            'modified_date' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%object_activity}}');
    }
}
