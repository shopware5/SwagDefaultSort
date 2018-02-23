<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;

use Shopware\SwagDefaultSort\Components\DataAccess\TableVo;
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

        $this->assertContainsOnlyInstancesOf(TableVo::class, $tableVos);
        $this->assertGreaterThan(0, count($tableVos));

        foreach ($tableVos as $tableVo) {
            $this->assertNotEmpty($tableVo->getTableName());
        }
    }
}
