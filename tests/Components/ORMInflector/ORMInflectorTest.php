<?php

namespace Shopware\SwagDefaultSort\Test\Components\ORMInflector;

use \Shopware\SwagDefaultSort\Components\ORMInflector\ORMInflector;

class ORMInflectorTest extends \Shopware\Components\Test\Plugin\TestCase {

    /**
     * @var ORMInflector
     */
    private $ormInflector;

    public function setUp() {
        $this->ormInflector = new ORMInflector(Shopware()->Models());
    }

    public function testReverseMapper() {
        $this->assertInstanceOf(
            'Shopware\SwagDefaultSort\Components\ORMInflector\InflectorResult',
            $this->ormInflector->getTable('s_articles')
        );
    }

    public function testResult() {
        $result = $this->ormInflector->getTable('s_articles');

        $this->assertEquals(
            's_articles',
            $result->getTableName()
        );

        $this->assertEquals(
            'Shopware\Models\Article\Article',
            $result->getClassName()
        );

        $this->assertContains(
            'main_detail_id',
            $result->getFieldNames()
        );

        $this->assertContains(
            'mainDetailId',
            $result->getPropertyNames()
        );
    }

    public function testMap() {
        $map = $this->ormInflector->getTable('s_articles')->getMap();

        $this->assertInstanceOf('Shopware\SwagDefaultSort\Components\ORMInflector\Map', $map);

        $this->assertEquals(
            'main_detail_id',
            $map->getDbValue('mainDetailId')
        );

        $this->assertEquals(
            'mainDetailId',
            $map->getOrmValue('main_detail_id')
        );

        $this->assertArrayHasKey(
            'main_detail_id',
            $map->getOrmIterator()
        );

        $this->assertArrayHasKey(
            'mainDetailId',
            $map->getDbIterator()
        );
    }

}