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
 * Class Taxes.
 *
 * Supports s_core_tax
 */
class Taxes extends AbstractJoinProvider
{
    /**
     * {@inheritdoc}
     */
    public function getTableName()
    {
        return 's_core_tax';
    }

    /**
     * {@inheritdoc}
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
            $alias . '.id = product.taxID'
        );

        $queryBuilder->addState($alias);

        return $alias;
    }
}
