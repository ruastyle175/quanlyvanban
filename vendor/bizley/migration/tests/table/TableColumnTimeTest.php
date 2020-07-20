<?php

namespace bizley\migration\tests\table;

use bizley\migration\table\TableColumnTime;

class TableColumnTimeTest extends TableColumnTestCase
{
    public function testDefinitionSpecific()
    {
        $column = new TableColumnTime(['precision' => 4]);
        $this->assertEquals('$this->time(4)', $column->renderDefinition($this->getTable(false)));
    }

    public function testDefinitionGeneral()
    {
        $column = new TableColumnTime(['precision' => 4]);
        $this->assertEquals('$this->time()', $column->renderDefinition($this->getTable()));
    }
}
