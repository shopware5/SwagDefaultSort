<?php


namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;


use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;

class OrderDetails extends AbstractJoinProvider {

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
        return 's_order_details';
    }

    /**
     * Extends the query and returns the alias to bind the definitition to
     *
     * @param QueryBuilder $queryBuilder
     * @return string
     */
    public function extendQuery(QueryBuilder $queryBuilder)
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