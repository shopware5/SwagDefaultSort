<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;

use Shopware\Models\Shop\Shop;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\FallbackDefinitionTranslateFilter;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\FromDefinitionUidFilter;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\FromTableDefinitionFilter;
use Shopware\SwagDefaultSort\Components\ORMReflector\ORMReflector;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ArticleAttributes\AttributeTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\SortDefinition\TranslateTableInterface;

class TranslateFilterChainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    public function setUp()
    {
        $this->definitionCollection = new DefinitionCollection();
    }

    public function testCombined()
    {
        $shops = Shopware()->Models()->getRepository(Shop::class)->findAll();

        foreach ($shops as $shop) {
            Shopware()->Snippets()->setShop($shop);

            /** @var AbstractSortDefinition $definition */
            foreach ($this->definitionCollection as $definition) {
                $table = $definition->getTable();

                if ($table instanceof AttributeTableLoader) {
                    $this->assertNotEquals($definition, $this->getFromDefaultDefinitionFilter()->filter($definition));
                    continue;
                }

                if ($table instanceof TranslateTableInterface) {
                    $this->assertNotEquals($definition, $this->getFromTableTranslateFilter()->filter($definition), $definition->getUniqueIdentifier());
                    continue;
                }

                $this->assertNotEquals($definition, $this->getFromDefinitionUidTranslateFilter()->filter($definition));
            }
        }
    }

    /**
     * @return FromTableDefinitionFilter
     */
    private function getFromTableTranslateFilter()
    {
        return new FromTableDefinitionFilter(
            Shopware()->Snippets(),
            new ORMReflector(Shopware()->Models())
        );
    }

    /**
     * @return FromDefinitionUidFilter
     */
    private function getFromDefinitionUidTranslateFilter()
    {
        return new FromDefinitionUidFilter(Shopware()->Snippets()->getNamespace('backend/swagdefaultsort/fields'));
    }

    /**
     * @return FallbackDefinitionTranslateFilter
     */
    private function getFromDefaultDefinitionFilter()
    {
        return new FallbackDefinitionTranslateFilter();
    }
}
