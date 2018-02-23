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
 * Class ArticleDetails.
 *
 * Supports s_articles_details
 */
class ArticleDetails extends AbstractJoinProvider
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_details';
    }

    /**
     * Extends the query and returns the alias to bind the definition to.
     *
     * @param QueryBuilder           $queryBuilder
     * @param AbstractSortDefinition $definition
     *
     * @return string
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        $alias = $this->createAlias('Variant');

        if ($queryBuilder->hasState($alias)) {
            return $alias;
        }

        $queryBuilder->addState($alias);

        return 'variant';
    }
}
