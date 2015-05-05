<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;

class Articles extends AbstractJoinProvider {

    /**
     * {@inheritdoc}
     */
    public function getType() {
        return self::TYPE_TABLE;
    }

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
    public function extendQuery(QueryBuilder $queryBuilder)
    {
        return 'product';
    }
}