<?php

namespace Shopware\SwagDefaultSort\Test\Components\QueryExtender;

use Shopware\SwagDefaultSort\Components\ORMReflector\ORMReflector;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\AbstractExpressionJoinProvider;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider\AbstractJoinProvider;
use Shopware\SwagDefaultSort\Components\QueryExtender\JoinProviderCollection;
use Shopware\SwagDefaultSort\Components\SortDefinition\ArticleAttributes\AttributeTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\ArticleAttributes\GenericDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails\ArticleDetailsHeight;
use Shopware\SwagDefaultSort\Components\SortDefinition\ArticleDetails\DetailsTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\Articles\ArticleName;
use Shopware\SwagDefaultSort\Components\SortDefinition\Articles\ArticleTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails\OrderTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails\SumOrderAmount;
use Shopware\SwagDefaultSort\Components\SortDefinition\Prices\PricesPrice;
use Shopware\SwagDefaultSort\Components\SortDefinition\Prices\PricesTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\Votes\SumPoints;
use Shopware\SwagDefaultSort\Components\SortDefinition\Votes\VotesTableLoader;
use Shopware\SwagDefaultSort\Test\AbstractSearchBundleDependantTest;

class JoinProviderTest extends AbstractSearchBundleDependantTest
{
    private $tableDefinitions = [];

    private $interfaceDefinitions = [];

    public function setUp()
    {
        parent::setUp();

        $this->tableDefinitions['s_articles'] = new ArticleName(new ArticleTableLoader());
        $this->tableDefinitions['s_articles_attribute'] = new GenericDefinition('attr1', new AttributeTableLoader(new ORMReflector(Shopware()->Models())));
        $this->tableDefinitions['s_articles_details'] = new ArticleDetailsHeight(new DetailsTableLoader());
        $this->tableDefinitions['s_order_details'] = $this->getMockBuilder('Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition');
        $this->tableDefinitions['s_articles_prices'] = new PricesPrice(new PricesTableLoader());

        $this->interfaceDefinitions['s_order_details'] = new SumOrderAmount(new OrderTableLoader());
        $this->interfaceDefinitions['s_articles_vote'] = new SumPoints(new VotesTableLoader());
    }

    private function createJoinCollection()
    {
        return new JoinProviderCollection();
    }

    public function testJoinCollection()
    {
        $joinCollection = $this->createJoinCollection();

        $this->assertGreaterThan(0, count($joinCollection));
        $this->containsOnlyInstancesOf('Shopware\SwagDefaultSort\Components\QueryExtender\JoinQueryExtender\AbstractJoinProvider', $joinCollection);
    }

    public function testSingleJoinProviders()
    {
        /** @var AbstractJoinProvider $joinProvider */
        foreach ($this->createJoinCollection() as $joinProvider) {
            $def = $this->getDefinition($joinProvider);

            $qb = $this->getQueryBuilder();

            $qb->select('*');

            $alias = $joinProvider->extendQuery($qb, $def);

            $this->assertContains($alias, $qb->getSQL(), 'test if alias is present');

            $stmt = $qb->execute();

            $this->assertTrue(is_array($stmt->fetchAll()));
        }
    }

    public function testJoinProvidersDoubleCall()
    {
        /** @var AbstractJoinProvider $joinProvider */
        foreach ($this->createJoinCollection() as $joinProvider) {
            $qb = $this->getQueryBuilder();

            $def = $this->getDefinition($joinProvider);

            $qb->select('*');

            $alias = $joinProvider->extendQuery($qb, $def);
            $alias = $joinProvider->extendQuery($qb, $def);

            $this->assertContains($alias, $qb->getSQL(), 'test if alias is present');

            $stmt = $qb->execute();

            $this->assertTrue(is_array($stmt->fetchAll()));
        }
    }

    public function testJoinProvidersCombinded()
    {
        $qb = $this->getQueryBuilder();
        $qb->select('*');

        /** @var AbstractJoinProvider $joinProvider */
        foreach ($this->createJoinCollection() as $joinProvider) {
            $def = $this->getDefinition($joinProvider);

            $alias = $joinProvider->extendQuery($qb, $def);

            $this->assertContains($alias, $qb->getSQL(), 'test if alias is present');

            $stmt = $qb->execute();

            $this->assertTrue(is_array($stmt->fetchAll()));
        }
    }

    private function getDefinition(AbstractJoinProvider $joinProvider)
    {
        if ($joinProvider instanceof AbstractExpressionJoinProvider) {
            return $this->interfaceDefinitions[$joinProvider->getTableName()];
        }

        return $this->tableDefinitions[$joinProvider->getTableName()];
    }
}
