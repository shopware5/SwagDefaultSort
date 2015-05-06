<?php

namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;

use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class Taxes.
 *
 * Supports s_core_tax
 */
class Taxes extends AbstractJoinProvider
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_core_tax';
    }

    /**
     * Extends the query and returns the alias to bind the definitition to.
     *
     * @param QueryBuilder $queryBuilder
     *
     * @return string
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        $alias = $this->createAlias('Tax');

        if ($queryBuilder->hasState($alias)) {
            return $alias;
        }

        $queryBuilder->leftJoin(
            'product',
            $this->getTableName(),
            $alias,
            $alias.'.id = product.taxID'
        );

        $queryBuilder->addState($alias);

        return $alias;
    }
}
