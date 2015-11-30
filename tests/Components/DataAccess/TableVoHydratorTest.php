<?php

namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;

use Shopware\SwagDefaultSort\Components\DataAccess\TableVoHydrator;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class TableVoHydratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    /**
     * @var TableVoHydrator
     */
    private $tableVoHydrator;

    public function setUp()
    {
        $this->definitionCollection = new DefinitionCollection();
        $this->tableVoHydrator = new TableVoHydrator(Shopware()->Snippets());
    }

    public function testGetters()
    {
        $tableVos = $this->tableVoHydrator->createTableVos($this->definitionCollection->getTableNames());

        $this->assertContainsOnlyInstancesOf('Shopware\SwagDefaultSort\Components\DataAccess\TableVo', $tableVos);
        $this->assertGreaterThan(0, count($tableVos));

        foreach ($tableVos as $tableVo) {
            $this->assertNotEmpty($tableVo->getTableName());
        }
    }
}
