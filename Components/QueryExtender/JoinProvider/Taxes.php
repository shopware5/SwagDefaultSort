<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;

class Taxes extends AbstractJoinProvider {

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
        return 's_core_tax';
    }

    /**
     * Extends the query and returns the alias to bind the definitition to
     *
     * @param QueryBuilder $queryBuilder
     * @return string
     */
    public function extendQuery(QueryBuilder $queryBuilder)
    {
        $alias = $this->createAlias('Tax');

        if($queryBuilder->hasState($alias)) {
            return $alias;
        }

        $queryBuilder->leftJoin(
            'product',
            $this->getTableName(),
            $alias,
            $alias . '.id = product.taxID'
        );

        $queryBuilder->addState($alias);

        return $alias;
    }
}