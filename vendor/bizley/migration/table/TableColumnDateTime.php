<?php

namespace bizley\migration\table;

/**
 * Class TableColumnDateTime
 * @package bizley\migration\table
 */
class TableColumnDateTime extends TableColumn
{
    /**
     * Returns length of the column.
     * @return int|string
     */
    public function getLength()
    {
        return $this->precision;
    }

    /**
     * Sets length of the column.
     * @param $value
     */
    public function setLength($value)
    {
        $this->precision = $value;
    }

    /**
     * Builds methods chain for column definition.
     * @param TableStructure $table
     */
    public function buildSpecificDefinition($table)
    {
        $this->definition[] = 'dateTime(' . ($table->generalSchema ? null : $this->length) . ')';
    }
}
