<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

/**
 * Class OrderDetailsExpressionJoinProvider
 *
 * Supports s_order_details + ExpressionConditionInterface
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider
 */
class OrderDetailsExpressionJoinProvider extends AbstractExpressionJoinProvider {

    public function isSupportedInterface(AbstractSortDefinition $sortDefinition)
    {
        return $sortDefinition instanceof ExpressionConditionInterface && $sortDefinition->getTableName() == $this->getTableName();
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_order_details';
    }

    /**
     * Extends the query and returns the alias to bind the definition to
     *
     * @param QueryBuilder $queryBuilder
     * @param AbstractSortDefinition $definition
     * @return string join alias
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        $alias = $this->createAlias('Select');

        if($queryBuilder->hasState($alias)) {
            return $alias;
        }

        $subQueryAlias = $this->createAlias('Inner');

        $subQueryBuilder = Shopware()->Models()->getDBALQueryBuilder();

        $subQueryBuilder->select($this->getSelectWithExpression($definition, $subQueryAlias))
            ->from($this->getTableName(), $subQueryAlias)
            ->where('product.id = ' . $subQueryAlias . '.articleID');

        $queryBuilder->addSelect('(' . $subQueryBuilder->getSQL() . ') AS ' . $alias . '_' . $definition->getFieldName());

        return $alias;
    }
}