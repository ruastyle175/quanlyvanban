<?php

namespace bizley\migration\tests\mysql;

use bizley\migration\Generator;
use Yii;

class GeneratorTest extends MysqlDbTestCase
{
    protected function getGenerator($tableName)
    {
        return new Generator([
            'db' => Yii::$app->db,
            'tableName' => $tableName,
        ]);
    }

    public function testMysqlSchema()
    {
        $table = $this->getGenerator('test_pk')->table;
        $this->assertEquals('mysql', $table->schema);
    }

    public function testPrimaryKeyNonComposite()
    {
        $table = $this->getGenerator('test_pk')->table;
        $this->assertEquals(['id'], $table->primaryKey->columns);
        $this->assertEquals(null, $table->primaryKey->name);
        $this->assertFalse($table->primaryKey->isComposite());
    }

    public function testPrimaryKeyComposite()
    {
        $table = $this->getGenerator('test_pk_composite')->table;
        $this->assertEquals(['one', 'two'], $table->primaryKey->columns);
        $this->assertEquals(null, $table->primaryKey->name);
        $this->assertTrue($table->primaryKey->isComposite());
    }

    public function testIndexSingle()
    {
        if (!method_exists(Yii::$app->db->schema, 'getTableIndexes')) {
            $this->markTestSkipped('Non-unique indexes are tracked since Yii 2.0.13.');
        }
        $table = $this->getGenerator('test_index_single')->table;
        $this->assertArrayHasKey('idx-test_index_single-col', $table->indexes);
        $this->assertEquals(['col'], $table->indexes['idx-test_index_single-col']->columns);
        $this->assertEquals('idx-test_index_single-col', $table->indexes['idx-test_index_single-col']->name);
        $this->assertFalse($table->indexes['idx-test_index_single-col']->unique);
    }

    public function testIndexUnique()
    {
        $table = $this->getGenerator('test_index_unique')->table;
        $this->assertArrayHasKey('idx-test_index_unique-col', $table->indexes);
        $this->assertEquals(['col'], $table->indexes['idx-test_index_unique-col']->columns);
        $this->assertEquals('idx-test_index_unique-col', $table->indexes['idx-test_index_unique-col']->name);
        $this->assertTrue($table->indexes['idx-test_index_unique-col']->unique);
    }

    public function testIndexMulti()
    {
        if (!method_exists(Yii::$app->db->schema, 'getTableIndexes')) {
            $this->markTestSkipped('Non-unique indexes are tracked since Yii 2.0.13.');
        }
        $table = $this->getGenerator('test_index_multi')->table;
        $this->assertArrayHasKey('idx-test_index_multi-cols', $table->indexes);
        $this->assertEquals(['one', 'two'], $table->indexes['idx-test_index_multi-cols']->columns);
        $this->assertEquals('idx-test_index_multi-cols', $table->indexes['idx-test_index_multi-cols']->name);
        $this->assertFalse($table->indexes['idx-test_index_multi-cols']->unique);
    }

    public function testForeignKey()
    {
        $table = $this->getGenerator('test_fk')->table;
        $this->assertArrayHasKey('fk-test_fk-pk_id', $table->foreignKeys);
        $this->assertEquals(['pk_id'], $table->foreignKeys['fk-test_fk-pk_id']->columns);
        $this->assertEquals('test_pk', $table->foreignKeys['fk-test_fk-pk_id']->refTable);
        $this->assertEquals(['id'], $table->foreignKeys['fk-test_fk-pk_id']->refColumns);
        $this->assertEquals('fk-test_fk-pk_id', $table->foreignKeys['fk-test_fk-pk_id']->name);
    }
}
