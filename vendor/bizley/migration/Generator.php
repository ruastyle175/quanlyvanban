<?php

namespace bizley\migration;

use bizley\migration\table\TableColumn;
use bizley\migration\table\TableColumnFactory;
use bizley\migration\table\TableForeignKey;
use bizley\migration\table\TableIndex;
use bizley\migration\table\TablePrimaryKey;
use bizley\migration\table\TableStructure;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\base\NotSupportedException;
use yii\base\View;
use yii\db\Connection;
use yii\db\TableSchema;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * Class Generator
 * @package bizley\migration
 *
 * @property TableSchema $tableSchema
 * @property array $structure
 * @property TableStructure $table
 * @property-read string|null $normalizedNamespace
 */
class Generator extends Component
{
    /**
     * @var Connection DB connection.
     */
    public $db;

    /**
     * @var string Table name to be generated (before prefix).
     */
    public $tableName;

    /**
     * @var string Migration class name.
     */
    public $className;

    /**
     * @var View View used in controller.
     */
    public $view;

    /**
     * @var bool Table prefix flag.
     */
    public $useTablePrefix = true;

    /**
     * @var string File template.
     */
    public $templateFile;

    /**
     * @var string File update template.
     */
    public $templateFileUpdate;

    /**
     * @var string Migration namespace.
     */
    public $namespace;

    /**
     * @var bool Whether to use general column schema instead of database specific.
     */
    public $generalSchema = true;

    /**
     * Checks if DB connection is passed.
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (!($this->db instanceof Connection)) {
            throw new InvalidConfigException("Parameter 'db' must be an instance of yii\\db\\Connection!");
        }
    }

    protected $_tableSchema;

    /**
     * Returns table schema.
     * @return TableSchema
     */
    public function getTableSchema()
    {
        if ($this->_tableSchema === null) {
            $this->_tableSchema = $this->db->getTableSchema($this->tableName);
        }
        return $this->_tableSchema;
    }

    /**
     * Returns table primary key.
     * @return TablePrimaryKey
     */
    protected function getTablePrimaryKey()
    {
        $data = [];
        if (method_exists($this->db->schema, 'getTablePrimaryKey')) {
            /* @var $constraint \yii\db\Constraint */
            $constraint = $this->db->schema->getTablePrimaryKey($this->tableName, true);
            if ($constraint) {
                $data = [
                    'columns' => $constraint->columnNames,
                    'name' => $constraint->name,
                ];
            }
        } elseif ($this->tableSchema instanceof TableSchema) {
            if ($this->tableSchema->primaryKey) {
                $data = [
                    'columns' => $this->tableSchema->primaryKey,
                ];
            }
        }
        return new TablePrimaryKey($data);
    }

    /**
     * Returns columns structure.
     * @param $indexes TableIndex[]
     * @return TableColumn[]
     * @throws InvalidConfigException
     */
    protected function getTableColumns($indexes = [])
    {
        $columns = [];
        if ($this->tableSchema instanceof TableSchema) {
            $indexData = !empty($indexes) ? $indexes : $this->getTableIndexes();
            foreach ($this->tableSchema->columns as $column) {
                $isUnique = false;
                foreach ($indexData as $index) {
                    if ($index->unique && $index->columns[0] === $column->name && count($index->columns) === 1) {
                        $isUnique = true;
                        break;
                    }
                }
                $columns[$column->name] = TableColumnFactory::build([
                    'name' => $column->name,
                    'type' => $column->type,
                    'size' => $column->size,
                    'precision' => $column->precision,
                    'scale' => $column->scale,
                    'isNotNull' => $column->allowNull ? null : true,
                    'isUnique' => $isUnique,
                    'check' => null,
                    'default' => $column->defaultValue,
                    'isPrimaryKey' => $column->isPrimaryKey,
                    'autoIncrement' => $column->autoIncrement,
                    'isUnsigned' => $column->unsigned,
                    'comment' => $column->comment,
                ]);
            }
        }
        return $columns;
    }

    /**
     * Returns foreign keys structure.
     * @return TableForeignKey[]
     */
    protected function getTableForeignKeys()
    {
        $data = [];
        if (method_exists($this->db->schema, 'getTableForeignKeys')) {
            $fks = $this->db->schema->getTableForeignKeys($this->tableName, true);
            /* @var $fk \yii\db\ForeignKeyConstraint */
            foreach ($fks as $fk) {
                $data[$fk->name] = new TableForeignKey([
                    'name' => $fk->name,
                    'columns' => $fk->columnNames,
                    'refTable' => $fk->foreignTableName,
                    'refColumns' => $fk->foreignColumnNames,
                    'onDelete' => $fk->onDelete,
                    'onUpdate' => $fk->onUpdate,
                ]);
            }
        } elseif ($this->tableSchema instanceof TableSchema) {
            foreach ($this->tableSchema->foreignKeys as $name => $key) {
                $fk = new TableForeignKey([
                    'name' => $name,
                    'refTable' => ArrayHelper::remove($key, 0),
                    'onDelete' => null,
                    'onUpdate' => null,
                ]);
                foreach ($key as $col => $ref) {
                    $fk->columns[] = $col;
                    $fk->refColumns[] = $ref;
                }
                $data[$name] = $fk;
            }
        }
        return $data;
    }

    /**
     * Returns table indexes.
     * @return TableIndex[]
     * @since 2.2.2
     */
    protected function getTableIndexes()
    {
        $data = [];
        if (method_exists($this->db->schema, 'getTableIndexes')) {
            $idxs = $this->db->schema->getTableIndexes($this->tableName, true);
            /* @var $idx \yii\db\IndexConstraint */
            foreach ($idxs as $idx) {
                if (!$idx->isPrimary) {
                    $data[$idx->name] = new TableIndex([
                        'name' => $idx->name,
                        'unique' => $idx->isUnique,
                        'columns' => $idx->columnNames
                    ]);
                }
            }
        } else {
            try {
                $uidxs = $this->db->schema->findUniqueIndexes($this->tableSchema);
                foreach ($uidxs as $name => $cols) {
                    $data[$name] = new TableIndex([
                        'name' => $name,
                        'unique' => true,
                        'columns' => $cols
                    ]);
                }
            } catch (NotSupportedException $exc) {}
        }
        return $data;
    }

    private $_table;

    /**
     * Returns table data
     * @return TableStructure
     * @throws InvalidConfigException
     */
    public function getTable()
    {
        if ($this->_table === null) {
            $indexes = $this->getTableIndexes();
            $this->_table = new TableStructure([
                'name' => $this->tableName,
                'schema' => get_class($this->db->schema),
                'generalSchema' => $this->generalSchema,
                'usePrefix' => $this->useTablePrefix,
                'dbPrefix' => $this->db->tablePrefix,
                'primaryKey' => $this->getTablePrimaryKey(),
                'columns' => $this->getTableColumns($indexes),
                'foreignKeys' => $this->getTableForeignKeys(),
                'indexes' => $indexes
            ]);
        }
        return $this->_table;
    }

    /**
     * Returns normalized namespace.
     * @return null|string
     */
    public function getNormalizedNamespace()
    {
        return !empty($this->namespace) ? FileHelper::normalizePath($this->namespace, '\\') : null;
    }

    /**
     * Generates migration content or echoes exception message.
     * @return string
     * @throws InvalidParamException
     */
    public function generateMigration()
    {
        return $this->view->renderFile(Yii::getAlias($this->templateFile), [
            'table' => $this->table,
            'className' => $this->className,
            'namespace' => $this->normalizedNamespace
        ]);
    }
}
