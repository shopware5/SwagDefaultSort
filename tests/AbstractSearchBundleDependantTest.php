<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Test;

use Shopware\Bundle\SearchBundle\Criteria;
use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\Bundle\SearchBundleDBAL\QueryBuilderFactoryInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;

abstract class AbstractSearchBundleDependantTest extends \Shopware\Components\Test\Plugin\TestCase
{
    /**
     * @var QueryBuilderFactoryInterface
     */
    protected $queryBuilderFactory;

    /**
     * @var ShopContextInterface
     */
    protected $context;

    /**
     * @var Criteria
     */
    protected $criteria;

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    public function setUp()
    {
        $this->context = Shopware()->Container()->get('shopware_storefront.context_service')->getShopContext();
        $this->queryBuilderFactory = Shopware()->Container()->get('shopware_searchdbal.dbal_query_builder_factory');
        $this->criteria = new Criteria();
    }

    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder()
    {
        return $this->queryBuilderFactory->createQuery($this->criteria, $this->context);
    }
}
