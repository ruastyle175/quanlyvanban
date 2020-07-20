<?php

namespace bizley\migration\tests\table;

use bizley\migration\table\TableColumnJson;

class TableColumnJsonTest extends TableColumnTestCase
{
    public function testDefinition()
    {
        $column = new TableColumnJson();
        $this->assertEquals('$this->json()', $column->renderDefinition($this->getTable()));
    }
}
