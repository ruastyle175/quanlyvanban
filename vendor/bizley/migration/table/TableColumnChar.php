<?php

namespace bizley\migration\table;

/**
 * Class TableColumnChar
 * @package bizley\migration\table
 */
class TableColumnChar extends TableColumn
{
    /**
     * Builds methods chain for column definition.
     * @param TableStructure $table
     */
    public function buildSpecificDefinition($table)
    {
        $this->definition[] = 'char(' . ($table->generalSchema ? null : $this->length) . ')';
    }
}
