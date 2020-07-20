<?php

use yii\db\Migration;

class m190131_073737_create_table_testtool extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%testtool}}', [
            'id' => $this->primaryKey()->comment('something:)'),
            'category_id' => $this->integer()->comment('LOOKUP:object_category|id|name'),
            'floet' => $this->float()->comment('DROPDOWN:{"12.5":"Xx XX","2.7":"YY i YY"}'),
            'type' => $this->string()->defaultValue('')->comment('DROPDOWN:male Shit|female|unknown'),
            'something' => $this->string()->comment('DROPDOWN:{"xx":"Xx XX","yy":"YY i YY"}'),
            'int_type' => $this->integer()->comment('DROPDOWN:{"10":"Xx XX","20":"YY i YY"}'),
            'simple' => $this->string()->comment('DROPDOWN:11|222|333'),
            'image' => $this->string(),
            'attachment' => $this->string(),
            'content' => $this->string(),
            'is_active' => $this->tinyInteger(),
            'release_date' => $this->date(),
            'release_time' => $this->time(),
            'release_datetime' => $this->dateTime(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%testtool}}');
    }
}
