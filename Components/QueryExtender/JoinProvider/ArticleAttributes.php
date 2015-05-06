<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class ArticleAttributes
 *
 * Supports s_articles_attributes
 *
 * @package Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider
 */
class ArticleAttributes extends AbstractJoinProvider {

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_attributes';
    }

    /**
     * Extends the query and returns the alias to bind the definitition to
     *
     * @param QueryBuilder $queryBuilder
     * @return string
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        $alias = $this->createAlias('Attribute');

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