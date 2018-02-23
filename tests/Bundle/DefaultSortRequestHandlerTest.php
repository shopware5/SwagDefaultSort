<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test;

use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundleDBAL\QueryBuilderFactoryInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;
use Shopware\Components\Test\Plugin\TestCase;
use Shopware\SwagDefaultSort\Bundle\SearchBundle\DefaultSortRequestHandler;
use Shopware\SwagDefaultSort\Components\DataAccess\DatabaseAdapter;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleHydrator;

class DefaultSortRequestHandlerTest extends TestCase
{
    /**
     * @var QueryBuilderFactoryInterface
     */
    protected $queryBuilderFactory;

    /**
     * @var ShopContextInterface
     */
    protected $context;

    public function setUp()
    {
        $this->context = Shopware()->Container()->get('shopware_storefront.context_service')->getShopContext();
        $this->queryBuilderFactory = Shopware()->Container()->get('shopware_searchdbal.dbal_query_builder_factory');
    }

    public function testNoCategory()
    {
        $sortHandler = $this->createRequestHandler(
            $this->createDatabaseAdapter(false)
        );
        $request = $this->createRequest();
        $criteria = $this->createCriteria();

        $sortHandler->handleRequest(
            $request,
            $criteria,
            $this->context
        );

        $this->assertFalse($sortHandler->isEnabled());
        $this->assertEmpty($criteria->getSorting('swag-default-sort-default-sorting'));
    }

    public function testWithCategory()
    {
        $sortHandler = $this->createRequestHandler(
            $this->createDatabaseAdapter(false)
        );
        $request = $this->createRequest();
        $criteria = $this->createCriteria();

        $request->setParam('sCategory', 100);

        $sortHandler->handleRequest(
            $request,
            $criteria,
            $this->context
        );

        $this->assertFalse($sortHandler->isEnabled());
        $this->assertEmpty($criteria->getSorting('swag-default-sort-default-sorting'));
    }

    public function testWithCategoryAndActiveDatabase()
    {
        $sortHandler = $this->createRequestHandler(
            $this->createDatabaseAdapter(true)
        );
        $request = $this->createRequest();
        $criteria = $this->createCriteria();

        $request->setParam('sCategory', 100);

        $sortHandler->handleRequest(
            $request,
            $criteria,
            $this->context
        );

        $this->assertTrue($sortHandler->isEnabled());
        $this->assertNotEmpty($criteria->getSorting('swag-default-sort-default-sorting'));
    }

    public function testWithCategoryAndActiveDatabaseAndActiveSort()
    {
        $sortHandler = $this->createRequestHandler(
            $this->createDatabaseAdapter(true)
        );
        $request = $this->createRequest();
        $criteria = $this->createCriteria();

        $request->setParam('sCategory', 100);
        $request->setParam('sSort', 100);

        $sortHandler->handleRequest(
            $request,
            $criteria,
            $this->context
        );

        $this->assertTrue($sortHandler->isEnabled());
        $this->assertEmpty($criteria->getSorting('swag-default-sort-default-sorting'));
    }

    public function testWithCategoryAndActiveDatabaseAndActiveSortFromThisPlugin()
    {
        $sortHandler = $this->createRequestHandler(
            $this->createDatabaseAdapter(true)
        );
        $request = $this->createRequest();
        $criteria = $this->createCriteria();

        $request->setParam('sCategory', 100);
        $request->setParam('sSort', DefaultSortRequestHandler::REQUEST_VALUE);

        $sortHandler->handleRequest(
            $request,
            $criteria,
            $this->context
        );

        $this->assertTrue($sortHandler->isEnabled());
        $this->assertNotEmpty($criteria->getSorting('swag-default-sort-default-sorting'));
    }

    /**
     * @param DatabaseAdapter $dbAdapter
     *
     * @return DefaultSortRequestHandler
     */
    private function createRequestHandler(DatabaseAdapter $dbAdapter)
    {
        return new DefaultSortRequestHandler(
            $dbAdapter,
            new RuleHydrator()
        );
    }

    /**
     * @param bool $findsCategory
     *
     * @return DatabaseAdapter
     */
    private function createDatabaseAdapter($findsCategory = false)
    {
        $stub = $this->getMockBuilder(DatabaseAdapter::class)
            ->getMock();

        $stub->method('fetchClosestCategoryIdWithRule')
            ->willReturn($findsCategory ? 10 : null);

        $stub->method('fetchRawData')
            ->willReturn([]);

        return $stub;
    }

    /**
     * @return \Enlight_Controller_Request_RequestHttp
     */
    private function createRequest()
    {
        return new \Enlight_Controller_Request_RequestHttp();
    }

    /**
     * @return Criteria
     */
    private function createCriteria()
    {
        return new Criteria();
    }
}
