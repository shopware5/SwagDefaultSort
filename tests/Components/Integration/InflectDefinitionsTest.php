<?php


namespace Shopware\SwagDefaultSort\Test\Components\Integration\SortDefinition;


use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\ORMInflector\ORMInflector;

class InflectDefinitionsTest extends \Shopware\Components\Test\Plugin\TestCase {

    /**
     * @var ORMInflector
     */
    private $ormInflector;

    /**
     * @var DefinitionCollection
     */
    private $collection;

    public function setUp() {
        $this->ormInflector = new ORMInflector(Shopware()->Models());
        $this->collection = new DefinitionCollection();
    }

    public function testDefinitionsInflectable() {
        foreach($this->collection as $definition) {
            $map = $this
                ->ormInflector
                ->getTable($definition->getTableName())
                ->getMap();

            $this->assertNotEmpty($map->getOrmValue($definition->getFieldName()));
        }
    }
}