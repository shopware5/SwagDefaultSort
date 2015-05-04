<?php


namespace Shopware\SwagDefaultSort\Test\Components\ValueObject;
use Shopware\SwagDefaultSort\Components\ValueObject\DatabaseAdapter;


/**
 * Class DatabaseAdapter
 *
 * Sorry no fixtures here, will only test if the querys are valid....
 *
 * @package Shopware\SwagDefaultSort\Test\Components\Frontend
 */
class DatabaseAdapterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var DatabaseAdapter
     */
    private $dbAdapter;

    public function setUp() {
        $this->dbAdapter = new DatabaseAdapter(Shopware()->Models()->getDBALQueryBuilder());
    }

    public function testCategory() {
        $this->assertNotEmpty($this->dbAdapter->fetchClosestCategoryIdWithRule(12));
    }

    public function testRawData() {
        $this->assertEquals(true, is_array($this->dbAdapter->fetchRawData(12)));
    }

}