<?php


namespace Shopware\SwagDefaultSort\Test\Components\QueryExtender\JoinQueryExtender;

use Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider\OrderByFilterChain;
use Shopware\SwagDefaultSort\Components\SortDefinition\Articles\ArticleName;
use Shopware\SwagDefaultSort\Components\SortDefinition\Articles\ArticlesAbstract;
use Shopware\SwagDefaultSort\Components\SortDefinition\GroupExpressionConditionInterface;
use Shopware\SwagDefaultSort\Components\ValueObject\RuleVo;
use Shopware\SwagDefaultSort\Test\AbstractSearchBundleDependantTest;

class FieldQueryExtenderTest extends AbstractSearchBundleDependantTest
{

    public function testDefaultFieldQueryExtender()
    {
        $defaultFieldQueryExtender = new OrderByFilterChain();

        $ruleVo = new RuleVo(1);
        $ruleVo->setDefinitionUid('s_articles::name');
        $ruleVo->setDescending(true);
        $ruleVo->setOrder(0);

        $sortDefinition = new ArticleName();

        $qb = $this->getQueryBuilder();

        $defaultFieldQueryExtender->extendQuery(
            'product',
            $sortDefinition,
            $ruleVo,
            $qb
        );

        $this->assertContains('product.name DESC', $qb->getSQL());
    }

    public function testDefaultFieldQueryExtenderWithGroupExpressionCondition() {
        $defaultFieldQueryExtender = new OrderByFilterChain();

        $ruleVo = new RuleVo(1);
        $ruleVo->setDefinitionUid('s_articles::foo');
        $ruleVo->setDescending(true);
        $ruleVo->setOrder(0);

        $sortDefinition = new MockArticleNameDefinition();

        $qb = $this->getQueryBuilder();

        $defaultFieldQueryExtender->extendQuery(
            'product',
            $sortDefinition,
            $ruleVo,
            $qb
        );

        $this->assertContains('MIN(product.foo) DESC', $qb->getSQL());
    }
}

class MockArticleNameDefinition extends ArticlesAbstract implements GroupExpressionConditionInterface {

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