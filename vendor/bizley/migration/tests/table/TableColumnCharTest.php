<?php

namespace bizley\migration\tests\table;

use bizley\migration\table\TableColumnChar;

class TableColumnCharTest extends TableColumnTestCase
{
    public function testDefinitionSpecific()
    {
        $column = new TableColumnChar(['size' => 10]);
        $this->assertEquals('$this->char(10)', $column->renderDefinition($this->getTable(false)));
    }

    public function testDefinitionGeneral()
    {
        $column = new TableColumnChar(['size' => 10]);
        $this->assertEquals('$this->char()', $column->renderDefinition($this->getTable()));
    }
}
