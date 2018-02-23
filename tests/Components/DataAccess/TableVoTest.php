<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;

use Shopware\SwagDefaultSort\Components\DataAccess\TableVo;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\SimpleFilter;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\TranslateFilterChain;
use Shopware\SwagDefaultSort\Components\DataAccess\TranslateFilter;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class TableVoTest extends \PHPUnit_Framework_TestCase
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
        $shops = Shopware()->Models()->getRepository('Shopware\Models\Shop\Shop')->findAll();

        foreach ($shops as $shop) {
            Shopware()->Snippets()->setShop($shop);

            $filter = new TranslateFilterChain([
                new SimpleFilter(
                    Shopware()->Snippets()->getNamespace('backend/swagdefaultsort/tables')
                )
            ]);

            foreach ($this->definitionCollection->getTableNames() as $tableName) {
                $tableVo = new TableVo($tableName, $filter);

                $this->assertEquals($tableVo->getTableName(), $tableName);

                $json = json_encode($tableVo);
                $array = json_decode($json, true);

                $this->assertArrayHasKey('tableName', $array);
                $this->assertArrayHasKey('translation', $array);
            }
        }
    }
}
