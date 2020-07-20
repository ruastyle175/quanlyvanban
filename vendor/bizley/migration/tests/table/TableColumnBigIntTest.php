<?php

namespace bizley\migration\tests\table;

use bizley\migration\table\TableColumnBigInt;

class TableColumnBigIntTest extends TableColumnTestCase
{
    public function testDefinitionSpecific()
    {
        $column = new TableColumnBigInt(['size' => 20]);
        $this->assertEquals('$this->bigInteger(20)', $column->renderDefinition($this->getTable(false)));
    }

    public function testDefinitionGeneralComposite()
    {
        $column = new TableColumnBigInt(['size' => 20]);
        $this->assertEquals('$this->bigInteger()', $column->renderDefinition($this->getTable(true, true)));
    }

    public function testDefinitionGeneralNotPK()
    {
        $column = new TableColumnBigInt(['size' => 20, 'name' => 'other']);
        $this->assertEquals('$this->bigInteger()', $column->renderDefinition($this->getTable()));
    }

    public function testDefinitionGeneralPK()
    {
        $column = new TableColumnBigInt(['size' => 20, 'name' => 'one']);
        $this->assertEquals('$this->bigPrimaryKey()', $column->renderDefinition($this->getTable()));
    }
}
