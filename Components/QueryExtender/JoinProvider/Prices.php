<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\QueryExtender\JoinProvider;

use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class Prices.
 *
 * Supports s_articles_prices
 */
class Prices extends AbstractJoinProvider
{
    /**
     * {@inheritdoc}
     */
    public function getTableName()
    {
        return 's_articles_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        $alias = $this->createAlias();

        if ($queryBuilder->hasState($alias)) {
            return $alias;
        }

        $variantAlias = $this->createAlias('Details');

        $queryBuilder
            ->leftJoin(
                'product',
                's_articles_details',
                $variantAlias,
                $variantAlias . '.articleID = product.id'
            )->leftJoin(
                $variantAlias,
                $this->getTableName(),
                $alias,
                $alias . '.articledetailsID = ' . $variantAlias . '.id'
            );

        $queryBuilder->addState($alias);

        return $alias;
    }
}
