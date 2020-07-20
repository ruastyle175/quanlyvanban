<?php

namespace bizley\migration\tests\migrations;

use yii\db\Migration;

class m180328_205700_add_column_two_to_table_test_multiple extends Migration
{
    public function up()
    {
        $this->addColumn('{{%test_multiple}}', 'two', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%test_multiple}}', 'two');
    }
}
