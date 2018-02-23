<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;

use Shopware\SwagDefaultSort\Components\DataAccess\FieldVo;
use Shopware\SwagDefaultSort\Components\DataAccess\FieldVoHydrator;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class FieldVoHydratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    /**
     * @var FieldVoHydrator
     */
    private $fieldVoHydrator;

    public function setUp()
    {
        $this->definitionCollection = new DefinitionCollection();
        $this->fieldVoHydrator = new FieldVoHydrator(Shopware()->Snippets());
    }

    public function testGetters()
    {
        $fieldVos = $this->fieldVoHydrator->createFieldVos($this->definitionCollection);

        $this->assertContainsOnlyInstancesOf(FieldVo::class, $fieldVos);
        $this->assertGreaterThan(0, count($fieldVos));

        foreach ($fieldVos as $fieldVo) {
            $this->assertNotEmpty($fieldVo->getTableName());
            $this->assertNotEmpty($fieldVo->getDefinitionUid());
        }
    }
}
