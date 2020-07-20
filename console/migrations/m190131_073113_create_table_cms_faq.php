<?php

use yii\db\Migration;

class m190131_073113_create_table_cms_faq extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cms_faq}}', [
            'id' => $this->primaryKey(),
            'icon' => $this->string(),
            'color' => $this->string(),
            'question' => $this->string()->notNull(),
            'answer' => $this->string()->notNull(),
            'sort_order' => $this->integer()->notNull()->defaultValue('0'),
            'is_active' => $this->tinyInteger()->notNull()->defaultValue('1'),
            'created_date' => $this->string(),
            'modified_date' => $this->string(),
            'application_id' => $this->string()->comment('LOOKUP:application|id|name'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%cms_faq}}');
    }
}
