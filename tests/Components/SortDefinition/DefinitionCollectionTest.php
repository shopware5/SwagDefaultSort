<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\SortDefinition;

use Shopware\Components\Test\Plugin\TestCase;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class DefinitionCollectionTest extends TestCase
{
    /**
     * @var DefinitionCollection
     */
    private $collection;

    public function setUp()
    {
        $this->collection = new DefinitionCollection();
    }

    public function testAllForReturnValues()
    {
        foreach ($this->collection as $definition) {
            $this->assertNotEmpty($definition->getTableName());
            $this->assertNotEmpty($definition->getFieldName());
        }
    }

    public function testCount()
    {
        $this->assertGreaterThanOrEqual(1, count($this->collection));
    }

    public function testSubCollections()
    {
        foreach ($this->collection->getTableNames() as $tableName) {
            $iterator = $this->collection->getTableIterator($tableName);
            $this->assertNotEmpty($iterator, $tableName);
        }
    }
}
