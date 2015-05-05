<?php


namespace Shopware\SwagDefaultSort\Test\Components\Integration\ValueObject;


use Shopware\SwagDefaultSort\Components\ValueObject\FieldVoHydrator;
use Shopware\SwagDefaultSort\Components\ValueObject\TableVoHydrator;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class FieldVoHydratorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var DefinitionCollection
     */
    private $definitionCollection;

    /**
     * @var FieldVoHydrator
     */
    private $fieldVoHydrator;

    public function setUp() {
        $this->definitionCollection = new DefinitionCollection();
        $this->fieldVoHydrator = new FieldVoHydrator(Shopware()->Snippets());
    }

    public function testGetters() {
        $fieldVos = $this->fieldVoHydrator->createFieldVos($this->definitionCollection);

        $this->assertContainsOnlyInstancesOf('Shopware\SwagDefaultSort\Components\ValueObject\FieldVO', $fieldVos);
        $this->assertGreaterThan(0, count($fieldVos));

        foreach($fieldVos as $fieldVo) {
            $this->assertNotEmpty($fieldVo->getTableName());
            $this->assertNotEmpty($fieldVo->getDefinitionUid());

            //@todo inject / mock locale
            //$this->assertNotEmpty($tableVo->getTranslation(), 'No translation for "' . $tableVo->getTableName() . '"');
        }
    }

}