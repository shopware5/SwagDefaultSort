<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class Articles
 *
 * Supports s_articles
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider
 */
class Articles extends AbstractJoinProvider {

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles';
    }

    /**
     * Extends the query and returns the alias to bind the definitition to
     *
     * @param QueryBuilder $queryBuilder
     * @return string
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        return 'product';
    }
}