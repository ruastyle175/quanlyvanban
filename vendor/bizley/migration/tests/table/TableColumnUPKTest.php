<?php

namespace bizley\migration\tests\table;

use bizley\migration\table\TableColumnUPK;

class TableColumnUPKTest extends TableColumnTestCase
{
    public function testDefinitionSpecific()
    {
        $column = new TableColumnUPK(['size' => 11]);
        $this->assertEquals('$this->primaryKey(11)', $column->renderDefinition($this->getTable(false)));
    }

    public function testDefinitionGeneral()
    {
        $column = new TableColumnUPK(['size' => 11]);
        $this->assertEquals('$this->primaryKey()->unsigned()', $column->renderDefinition($this->getTable(true)));
    }
}
