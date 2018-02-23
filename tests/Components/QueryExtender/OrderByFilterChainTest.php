<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Test\Components\QueryExtender;

use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;
use Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider\OrderByFilterChain;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\Articles\ArticleTableLoader;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;
use Shopware\SwagDefaultSort\Components\SortDefinition\GenericDefinition;
use Shopware\SwagDefaultSort\Test\AbstractSearchBundleDependantTest;

class OrderByFilterChainTest extends AbstractSearchBundleDependantTest
{
    public function testDefaultFieldQueryExtender()
    {
        $defaultFieldQueryExtender = new OrderByFilterChain();

        $ruleVo = new RuleVo(1);
        $ruleVo->setDefinitionUid('s_articles::name');
        $ruleVo->setDescending(true);
        $ruleVo->setOrder(0);

        $sortDefinition = new GenericDefinition('name', new ArticleTableLoader());

        $qb = $this->getQueryBuilder();

        $defaultFieldQueryExtender->extendQuery(
            'product',
            $sortDefinition,
            $ruleVo,
            $qb
        );

        $this->assertContains('product.name DESC', $qb->getSQL());
    }

    public function testDefaultFieldQueryExtenderWithGroupExpressionCondition()
    {
        $defaultFieldQueryExtender = new OrderByFilterChain();

        $ruleVo = new RuleVo(1);
        $ruleVo->setDefinitionUid('s_articles::foo');
        $ruleVo->setDescending(true);
        $ruleVo->setOrder(0);

        $sortDefinition = new MockArticleNameDefinition(new ArticleTableLoader());

        $qb = $this->getQueryBuilder();

        $defaultFieldQueryExtender->extendQuery(
            'product',
            $sortDefinition,
            $ruleVo,
            $qb
        );

        $this->assertContains('product_foo DESC', $qb->getSQL());
    }
}

class MockArticleNameDefinition extends AbstractSortDefinition implements ExpressionConditionInterface
{
    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'foo';
    }

    /**
     * @return string
     */
    public function getGroupingFunction()
    {
        return self::GROUPFKT_MIN;
    }
}
