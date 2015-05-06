<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class OrderByProvider
 *
 * Provide the base order by conditions
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider
 */
class OrderByProvider
{

    const ORDER_ASC = 'ASC';

    const ORDER_DESC = 'DESC';

    /**
     * Info: Naming comes from DBALQuery Builder
     *
     * @param $alias
     * @param AbstractSortDefinition $definition
     * @return string
     */
    public function getSort(
        $alias,
        AbstractSortDefinition $definition
    )
    {
        $field = $alias . '.' . $definition->getFieldName();

        return $field;
    }

    /**
     * Info: Naming comes from DBALQuery Builder
     *
     * @param RuleVo $rule
     * @return string
     */
    public function getOrder(RuleVo $rule)
    {
        return $rule->isDescending() ? self::ORDER_DESC : self::ORDER_ASC;
    }
}