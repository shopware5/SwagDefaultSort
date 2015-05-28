<?php

namespace Shopware\SwagDefaultSort\Test\Components\ValueObject;

use Shopware\SwagDefaultSort\Components\DataAccess\DatabaseAdapter;

/**
 * Class DatabaseAdapter.
 *
 * Sorry no fixtures here, will only test if the querys are valid....
 */
class DatabaseAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DatabaseAdapter
     */
    private $dbAdapter;

    public function setUp()
    {
        $this->dbAdapter = new DatabaseAdapter(Shopware()->Container()->get('dbal_connection'));
    }

    public function testCategory()
    {
        $this->dbAdapter->fetchClosestCategoryIdWithRule(12);

        //if this is reached the query executed successfully
        $this->assertTrue(true);
    }

    public function testRawData()
    {
        $this->assertEquals(true, is_array($this->dbAdapter->fetchRawData(12)));
    }
}
