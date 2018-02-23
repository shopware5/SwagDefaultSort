<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\Integration\SortDefinition;

use Shopware\Components\Test\Plugin\TestCase;
use Shopware\SwagDefaultSort\Components\ORMReflector\ORMReflector;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class InflectDefinitionsTest extends TestCase
{
    /**
     * @var ORMReflector
     */
    private $ormInflector;

    /**
     * @var DefinitionCollection
     */
    private $collection;

    public function setUp()
    {
        $this->ormInflector = new ORMReflector(Shopware()->Models());
        $this->collection = new DefinitionCollection();
    }

    public function testDefinitionsInflectable()
    {
        /** @var AbstractSortDefinition $definition */
        foreach ($this->collection as $definition) {
            $map = $this
                ->ormInflector
                ->getTable($definition->getTableName())
                ->getMap();

            $this->assertNotEmpty($map->getOrmValue($definition->getFieldName()), $definition->getUniqueIdentifier() . ' - not mapped');
        }
    }
}
