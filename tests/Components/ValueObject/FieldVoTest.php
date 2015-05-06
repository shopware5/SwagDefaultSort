<?php

namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;

use Shopware\SwagDefaultSort\Components\DataAccess\FieldVo;
use Shopware\SwagDefaultSort\Components\DataAccess\TranslateFilter;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

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
        $shops = Shopware()->Models()->getRepository('Shopware\Models\Shop\Shop')->findAll();

        foreach ($shops as $shop) {
            Shopware()->Snippets()->setShop($shop);

            $filter = new TranslateFilter(Shopware()->Snippets()->getNamespace('backend/swwagdefaultsort/tables'));

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
