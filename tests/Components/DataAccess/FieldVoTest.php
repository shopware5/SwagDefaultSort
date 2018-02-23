<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;

use Shopware\Models\Shop\Shop;
use Shopware\SwagDefaultSort\Components\DataAccess\FieldVo;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\FallbackDefinitionTranslateFilter;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\TranslateFilterChain;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class FieldVoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    public function setUp()
    {
        $this->definitionCollection = new DefinitionCollection();
    }

    public function testGetters()
    {
        $shops = Shopware()->Models()->getRepository(Shop::class)->findAll();

        foreach ($shops as $shop) {
            Shopware()->Snippets()->setShop($shop);

            $filter = new TranslateFilterChain([
                new FallbackDefinitionTranslateFilter(),
            ]);

            /** @var AbstractSortDefinition $definition */
            foreach ($this->definitionCollection as $definition) {
                $fieldVo = new FieldVo(
                    $definition,
                    $filter
                );

                $json = json_encode($fieldVo);
                $array = json_decode($json, true);

                $this->assertArrayHasKey('tableName', $array);
                $this->assertArrayHasKey('translation', $array);
                $this->assertArrayHasKey('definitionUid', $array);
                $this->assertEquals($array['tableName'], $definition->getTableName());
                $this->assertEquals($array['definitionUid'], $definition->getUniqueIdentifier());
            }
        }
    }
}
