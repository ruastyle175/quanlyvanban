<?php

use yii\db\Migration;

class m190131_073227_create_table_content_digital extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content_digital}}', [
            'id' => $this->bigPrimaryKey(),
            'object_id' => $this->integer()->notNull(),
            'object_type' => $this->string()->notNull(),
            'version' => $this->string(),
            'size' => $this->string(),
            'os' => $this->string()->comment('data:android,ios'),
            'genre' => $this->string(),
            'min_os_version' => $this->string(),
            'max_os_version' => $this->string(),
            'min_processor' => $this->string(),
            'max_processor' => $this->string(),
            'min_ram' => $this->string(),
            'max_ram' => $this->string(),
            'min_storage' => $this->string(),
            'max_storage' => $this->string(),
            'min_graphic_card' => $this->string(),
            'max_graphic_card' => $this->string(),
            'min_directx' => $this->string(),
            'max_directx' => $this->string(),
            'min_resolution' => $this->string(),
            'max_resolution' => $this->string(),
            'in_app' => $this->string(),
            'developer' => $this->string()->comment('from content_author'),
            'publisher' => $this->string()->comment('from cms_partner'),
            'language' => $this->string(),
            'franchise' => $this->string(),
            'pegi' => $this->string()->comment('https://pegi.info'),
            'content_descriptor' => $this->string()->comment('https://pegi.info'),
            'last_update' => $this->string(),
            'release_date' => $this->date(),
            'install_count' => $this->string(),
            'download_count' => $this->string(),
            'attachment' => $this->string(),
            'application_id' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%content_digital}}');
    }
}
