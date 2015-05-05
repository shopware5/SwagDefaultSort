<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\ValueObject\RuleVo;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

class OrderByProvider {

    const ORDER_ASC = 'ASC';

    const ORDER_DESC = 'DESC';

    public function getSort(
        $alias,
        AbstractSortDefinition $definition
    )
    {
        $field = $alias . '.' . $definition->getFieldName();

        return $field;
    }

    public function getOrder(RuleVo $rule)
    {
        return $rule->isDescending() ? self::ORDER_DESC : self::ORDER_ASC;
    }
}