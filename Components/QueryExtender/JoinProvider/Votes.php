<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class Votes
 *
 * Supports s_articles_vote
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider
 */
class Votes extends AbstractJoinProvider {


    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_vote';
    }

    /**
     * Extends the query and returns the alias to bind the definitition to
     *
     * @param QueryBuilder $queryBuilder
     * @return string
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        $alias = $this->createAlias('Variant');

        if($queryBuilder->hasState($alias)) {
            return $alias;
        }

        $queryBuilder->leftJoin(
            'product',
            $this->getTableName(),
            $alias,
            $alias . '.articleID = product.id'
        );

        $queryBuilder->addState($alias);

        return $alias;
    }
}