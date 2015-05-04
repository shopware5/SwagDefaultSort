<?php


namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;


use Shopware\SwagDefaultSort\Components\ValueObject\TableVO;
use Shopware\SwagDefaultSort\Components\ValueObject\TranslateFilter;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class TableVoCollectionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    public function setUp() {
        $this->definitionCollection = new DefinitionCollection();
    }

    public function testGetters() {
        $filter = new TranslateFilter(Shopware()->Snippets()->getNamespace('backend/swwagdefaultsort/fields'));

        foreach($this->definitionCollection->getTableNames() as $tableName) {
            $tableVo = new TableVO($tableName, $filter);

            //@todo mock the available locales to test whether everything is translated
//            $this->assertNotEmpty($tableVo->getTranslation());
//            $this->assertNotEquals($tableVo->getTranslation(), $tableName);


            $this->assertEquals($tableVo->getTableName(), $tableName);

            $json = json_encode($tableVo);
            $array = json_decode($json, true);

            $this->assertArrayHasKey('tableName', $array);
            $this->assertArrayHasKey('translation', $array);

        }
    }

}