<?php

namespace bizley\migration;

use bizley\migration\table\TableChange;
use bizley\migration\table\TableColumn;
use bizley\migration\table\TablePlan;
use bizley\migration\table\TablePrimaryKey;
use bizley\migration\table\TableStructure;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\console\controllers\MigrateController;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Class Updater
 * @package bizley\migration
 *
 * @property-read TableStructure $oldTable
 * @property TablePlan $plan
 */
class Updater extends Generator
{
    /**
     * @var string Name of the table for keeping applied migration information.
     */
    public $migrationTable = '{{%migration}}';

    /**
     * @var string Directory storing the migration classes. This can be either a path alias or a directory.
     */
    public $migrationPath = '@app/migrations';

    /**
     * @var bool Whether to only display changes instead of create updating migration.
     */
    public $showOnly = false;

    /**
     * @var array List of migration from the history that should be skipped during the update process.
     * Here you can place migrations containing actions that can not be covered by extractor.
     * @since 2.1.1
     */
    public $skipMigrations = [];

    private $_currentTable;

    /**
     * Sets current table name and clears skipped migrations names.
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->_currentTable = $this->tableName;
        foreach ($this->skipMigrations as $index => $migration) {
            $this->skipMigrations[$index] = trim($migration, '\\');
        }
    }

    /**
     * Sets dummy Migration class.
     * @throws InvalidParamException
     */
    protected function setDummyMigrationClass()
    {
        Yii::$classMap['yii\db\Migration'] = Yii::getAlias('@bizley/migration/dummy/Migration.php');
    }

    /**
     * Returns the migration history.
     * This is slightly modified MigrateController::getMigrationHistory() method.
     * Migrations are fetched from newest to oldest.
     * @return array the migration history
     */
    public function fetchHistory()
    {
        if ($this->db->schema->getTableSchema($this->migrationTable, true) === null) {
            return [];
        }
        $rows = (new Query())
            ->select(['version', 'apply_time'])
            ->from($this->migrationTable)
            ->orderBy(['apply_time' => SORT_DESC, 'version' => SORT_DESC])
            ->all($this->db);
        $history = [];
        foreach ($rows as $key => $row) {
            if ($row['version'] === MigrateController::BASE_MIGRATION) {
                continue;
            }
            if (preg_match('/m?(\d{6}_?\d{6})(\D.*)?$/is', $row['version'], $matches)) {
                $time = str_replace('_', '', $matches[1]);
                $row['canonicalVersion'] = $time;
            } else {
                $row['canonicalVersion'] = $row['version'];
            }
            $row['apply_time'] = (int)$row['apply_time'];
            $history[] = $row;
        }

        usort($history, function ($a, $b) {
            if ($a['apply_time'] === $b['apply_time']) {
                if (($compareResult = strcasecmp($b['canonicalVersion'], $a['canonicalVersion'])) !== 0) {
                    return $compareResult;
                }
                return strcasecmp($b['version'], $a['version']);
            }
            return ($a['apply_time'] > $b['apply_time']) ? -1 : 1;
        });
        return ArrayHelper::map($history, 'version', 'apply_time');
    }

    private $_appliedChanges = [];

    /**
     * Gathers applied changes.
     * @param array $changes
     * @return bool true if more data can be analysed or false if this must be last one
     * @since 2.3.0
     */
    protected function gatherChanges($changes)
    {
        if (!isset($changes[$this->_currentTable])) {
            return true;
        }
        $data = array_reverse($changes[$this->_currentTable]);
        /* @var $tableChange TableChange */
        foreach ($data as $tableChange) {
            if ($tableChange->method === 'dropTable') {
                return false;
            }
            if ($tableChange->method === 'renameTable') {
                $this->_currentTable = $tableChange->value;
                return $this->gatherChanges($changes);
            }
            $this->_appliedChanges[] = $tableChange;
            if ($tableChange->method === 'createTable') {
                return false;
            }
        }
        return true;
    }

    /**
     * Extracts migration data structures.
     * @param string $migration
     * @return array
     * @throws InvalidParamException
     * @throws ErrorException
     */
    protected function extract($migration)
    {
        if (strpos($migration, '\\') === false) {
            $file = Yii::getAlias($this->migrationPath . DIRECTORY_SEPARATOR . $migration . '.php');
            if (!file_exists($file)) {
                throw new ErrorException("File '{$file}' can not be found! Check migration history table.");
            }
            require_once $file;
        }

        $subject = new $migration;
        $subject->db = $this->db;
        $subject->up();

        return $subject->changes;
    }

    protected $_oldTable;

    /**
     * Returns the table structure as applied in gathered migrations.
     * @since 2.3.0
     * @throws \yii\base\InvalidParamException
     */
    public function getOldTable()
    {
        if ($this->_oldTable === null) {
            $this->_oldTable = new TableStructure([
                'schema' => get_class($this->db->schema),
                'generalSchema' => $this->generalSchema,
                'usePrefix' => $this->useTablePrefix,
                'dbPrefix' => $this->db->tablePrefix,
            ]);
            $this->_oldTable->applyChanges(array_reverse($this->_appliedChanges));
        }
        return $this->_oldTable;
    }

    /**
     * Returns values as a string.
     * @param mixed $value
     * @return string
     */
    public function displayValue($value)
    {
        if ($value === null) {
            return 'NULL';
        }
        if ($value === true) {
            return 'TRUE';
        }
        if ($value === false) {
            return 'FALSE';
        }
        return '"' . str_replace('"', '\"', $value) . '"';
    }

    /**
     * Confirms adding composite primary key and removes excessive PK statements.
     * @param array $newKeys
     * @return bool
     * @since 2.1.2
     */
    protected function confirmCompositePrimaryKey($newKeys)
    {
        if (count($this->table->primaryKey->columns) === 1 && count($newKeys) === 1) {
            /* @var $column TableColumn */
            foreach ($this->plan->addColumn as $name => $column) {
                if ($name === $newKeys[0] && ($column->isPrimaryKey || $column->isColumnAppendPK($this->table->schema))) {
                    return false;
                }
            }
            foreach ($this->plan->alterColumn as $name => $column) {
                if ($name === $newKeys[0] && ($column->isPrimaryKey || $column->isColumnAppendPK($this->table->schema))) {
                    return false;
                }
            }
            return true;
        }
        if (count($this->table->primaryKey->columns) > 1) {
            foreach ($newKeys as $key) {
                /* @var $column TableColumn */
                foreach ($this->plan->addColumn as $name => $column) {
                    if ($name === $key) {
                        $column->append = $column->removePKAppend($this->table->schema);
                    }
                }
                foreach ($this->plan->alterColumn as $name => $column) {
                    if ($name === $key) {
                        $column->append = $column->removePKAppend($this->table->schema);
                    }
                }
            }
        }
        return true;
    }

    private $_modifications;

    /**
     * @return TablePlan
     */
    public function getPlan()
    {
        if ($this->_modifications === null) {
            $this->_modifications = new TablePlan();
        }
        return $this->_modifications;
    }

    /**
     * Compares migration structure and database structure and gather required modifications.
     * @return bool whether modification is required or not
     */
    protected function compareStructures()
    {
        if (empty($this->_appliedChanges)) {
            return true;
        }
        $different = false;
        if ($this->showOnly) {
            echo "SHOWING DIFFERENCES:\n";
        }

        foreach ($this->table->columns as $name => $column) {
            if (!isset($this->oldTable->columns[$name])) {
                if ($this->showOnly) {
                    echo "   - missing column '$name'\n";
                } else {
                    $this->plan->addColumn[$name] = $column;
                }
                $different = true;
                continue;
            }
            foreach (TableColumn::properties() as $property) {
                if (!$this->generalSchema && $this->oldTable->columns[$name]->$property !== $column->$property) {
                    if ($this->showOnly) {
                        echo "   - different '$name' column property: $property (";
                        echo 'DB: ' . $this->displayValue($column->$property) . ' <> ';
                        echo 'MIG: ' . $this->displayValue($this->oldTable->columns[$name]->$property) . ")\n";
                    } else {
                        if (!isset($this->plan->alterColumn[$name])) {
                            $this->plan->alterColumn[$name] = $column;
                        }
                    }
                    $different = true;
                }
            }
        }
        foreach ($this->oldTable->columns as $name => $column) {
            if (!isset($this->table->columns[$name])) {
                if ($this->showOnly) {
                    echo "   - excessive column '$name'\n";
                } else {
                    $this->plan->dropColumn[] = $name;
                }
                $different = true;
            }
        }

        foreach ($this->table->foreignKeys as $name => $foreignKey) {
            if (!isset($this->oldTable->foreignKeys[$name])) {
                if ($this->showOnly) {
                    echo "   - missing foreign key '$name'\n";
                } else {
                    $this->plan->addForeignKey[$name] = $foreignKey;
                }
                $different = true;
                continue;
            }
            $tableFKColumns = !empty($this->table->foreignKeys[$name]->columns) ? $this->table->foreignKeys[$name]->columns : [];
            $oldTableFKColumns = !empty($this->oldTable->foreignKeys[$name]->columns) ? $this->oldTable->foreignKeys[$name]->columns : [];
            if (count(array_merge(array_diff($tableFKColumns, array_intersect($tableFKColumns, $oldTableFKColumns)),
                array_diff($oldTableFKColumns, array_intersect($tableFKColumns, $oldTableFKColumns))))) {
                if ($this->showOnly) {
                    echo "   - different foreign key '$name' columns (";
                    echo 'DB: (' . implode(', ', $tableFKColumns) . ') <> ';
                    echo 'MIG: (' . implode(', ', $oldTableFKColumns) . "))\n";
                } else {
                    $this->plan->dropForeignKey[] = $name;
                    $this->plan->addForeignKey[$name] = $foreignKey;
                }
                $different = true;
                continue;
            }
            $tableFKRefColumns = !empty($this->table->foreignKeys[$name]->refColumns) ? $this->table->foreignKeys[$name]->refColumns : [];
            $oldTableFKRefColumns = !empty($this->oldTable->foreignKeys[$name]->refColumns) ? $this->oldTable->foreignKeys[$name]->refColumns : [];
            if (count(array_merge(array_diff($tableFKRefColumns, array_intersect($tableFKRefColumns, $oldTableFKRefColumns)),
                array_diff($oldTableFKRefColumns, array_intersect($tableFKRefColumns, $oldTableFKRefColumns))))) {
                if ($this->showOnly) {
                    echo "   - different foreign key '$name' referral columns (";
                    echo 'DB: (' . implode(', ', $tableFKRefColumns) . ') <> ';
                    echo 'MIG: (' . implode(', ', $oldTableFKRefColumns) . "))\n";
                } else {
                    $this->plan->dropForeignKey[] = $name;
                    $this->plan->addForeignKey[$name] = $foreignKey;
                }
                $different = true;
            }
        }
        foreach ($this->oldTable->foreignKeys as $name => $foreignKey) {
            if (!isset($this->table->foreignKeys[$name])) {
                if ($this->showOnly) {
                    echo "   - excessive foreign key '$name'\n";
                } else {
                    $this->plan->dropForeignKey[] = $name;
                }
                $different = true;
            }
        }

        $tablePKColumns = !empty($this->table->primaryKey->columns) ? $this->table->primaryKey->columns : [];
        $oldTablePKColumns = !empty($this->oldTable->primaryKey->columns) ? $this->oldTable->primaryKey->columns : [];
        $newKeys = array_merge(array_diff($tablePKColumns, array_intersect($tablePKColumns, $oldTablePKColumns)),
            array_diff($oldTablePKColumns, array_intersect($tablePKColumns, $oldTablePKColumns)));
        if (count($newKeys)) {
            if ($this->showOnly) {
                echo "   - different primary key definition\n";
            } else {
                if (!empty($this->oldTable->primaryKey->columns)) {
                    $this->plan->dropPrimaryKey = $this->oldTable->primaryKey->name ?: TablePrimaryKey::GENERIC_PRIMARY_KEY;
                }
                if (!empty($this->table->primaryKey->columns) && $this->confirmCompositePrimaryKey($newKeys)) {
                    $this->plan->addPrimaryKey = $this->table->primaryKey;
                }
            }
            $different = true;
        }

        foreach ($this->table->indexes as $name => $index) {
            if (!isset($this->oldTable->indexes[$name])) {
                if ($this->showOnly) {
                    echo "   - missing index '$name'\n";
                } else {
                    $this->plan->createIndex[$name] = $index;
                }
                $different = true;
                continue;
            }
            if ($this->oldTable->indexes[$name]->unique !== $this->table->indexes[$name]->unique) {
                if ($this->showOnly) {
                    echo "   - different index '$name' definition (";
                    echo 'DB: unique ' . $this->displayValue($this->table->indexes[$name]->unique) . ' <> ';
                    echo 'MIG: unique ' . $this->displayValue($this->oldTable->indexes[$name]->unique) . ")\n";
                } else {
                    $this->plan->dropIndex[] = $name;
                    $this->plan->createIndex[$name] = $index;
                }
                $different = true;
                continue;
            }
            $tableIndexColumns = !empty($this->table->indexes[$name]->columns) ? $this->table->indexes[$name]->columns : [];
            $oldTableIndexColumns = !empty($this->oldTable->indexes[$name]->columns) ? $this->oldTable->indexes[$name]->columns : [];
            if (count(array_merge(array_diff($tableIndexColumns, array_intersect($tableIndexColumns, $oldTableIndexColumns)),
                array_diff($oldTableIndexColumns, array_intersect($tableIndexColumns, $oldTableIndexColumns))))) {
                if ($this->showOnly) {
                    echo "   - different index '$name' columns (";
                    echo 'DB: (' . implode(', ', $tableIndexColumns) . ') <> ';
                    echo 'MIG: (' . implode(', ', $oldTableIndexColumns) . "))\n";
                } else {
                    $this->plan->dropIndex[] = $name;
                    $this->plan->createIndex[$name] = $index;
                }
                $different = true;
            }
        }
        foreach ($this->oldTable->indexes as $name => $index) {
            if (!isset($this->table->indexes[$name])) {
                if ($this->showOnly) {
                    echo "   - excessive index '$name'\n";
                } else {
                    $this->plan->dropIndex[] = $name;
                }
                $different = true;
            }
        }

        return $different;
    }

    /**
     * Checks if new updating migration is required.
     * @return bool
     * @throws InvalidParamException
     * @throws ErrorException
     */
    public function isUpdateRequired()
    {
        $history = $this->fetchHistory();
        if (!empty($history)) {
            $this->setDummyMigrationClass();
            foreach ($history as $migration => $time) {
                $migration = trim($migration, '\\');
                if (in_array($migration, $this->skipMigrations, true)) {
                    continue;
                }
                if (!$this->gatherChanges($this->extract($migration))) {
                    break;
                }
            }
            return $this->compareStructures();
        }
        return true;
    }

    /**
     * Generates migration content or echoes exception message.
     * @return string
     * @throws InvalidParamException
     */
    public function generateMigration()
    {
        if (empty($this->_modifications)) {
            return parent::generateMigration();
        }
        return $this->view->renderFile(Yii::getAlias($this->templateFileUpdate), [
            'className' => $this->className,
            'table' => $this->table,
            'plan' => $this->plan,
            'namespace' => $this->normalizedNamespace
        ]);
    }
}
