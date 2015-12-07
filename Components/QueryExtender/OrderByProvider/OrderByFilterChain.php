<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;

use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;

/**
 * Class OrderByFilterChain.
 *
 * Extends the query with a collection of filters
 */
class OrderByFilterChain
{
    /**
     * @var OrderByProvider
     */
    private $orderByProvider;

    /**
     * @var AbstractOrderByFilter[]
     */
    private $orderByFilter;

    public function extendQuery(
        $alias,
        AbstractSortDefinition $definition,
        RuleVo $rule,
        QueryBuilder $queryBuilder
    ) {
        $sort = $this->getOrderByProvider()->getSort($alias, $definition);
        $order = $this->getOrderByProvider()->getOrder($rule);

        foreach ($this->getDataFilters() as $filter) {
            $filter->setUp($alias, $definition, $rule);

            $sort = $filter->filterSort($sort);
            $order = $filter->filterOrder($order);
        }

        $queryBuilder->addOrderBy($sort, $order);
    }

    public function getOrderByProvider()
    {
        if (!$this->orderByProvider) {
            $this->orderByProvider = new OrderByProvider();
        }

        return $this->orderByProvider;
    }

    public function getDataFilters()
    {
        if (!$this->orderByFilter) {
            $this->orderByFilter =  [
                new ExpressionConditionFilter(),
            ];
        }

        return $this->orderByFilter;
    }
}
