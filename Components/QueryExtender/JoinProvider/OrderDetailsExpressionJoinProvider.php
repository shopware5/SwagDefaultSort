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
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

/**
 * Class OrderDetailsExpressionJoinProvider.
 *
 * Supports s_order_details + ExpressionConditionInterface
 */
class OrderDetailsExpressionJoinProvider extends AbstractExpressionJoinProvider
{
    /**
     * {@inheritdoc}
     */
    public function isSupportedInterface(AbstractSortDefinition $sortDefinition)
    {
        return $sortDefinition instanceof ExpressionConditionInterface && $sortDefinition->getTableName() === $this->getTableName();
    }

    /**
     * {@inheritdoc}
     */
    public function getTableName()
    {
        return 's_order_details';
    }

    /**
     * {@inheritdoc}
     */
    public function extendQuery(QueryBuilder $queryBuilder, AbstractSortDefinition $definition)
    {
        $alias = $this->createAlias('Select');

        if ($queryBuilder->hasState($alias)) {
            return $alias;
        }

        $subQueryAlias = $this->createAlias('Inner');

        $subQueryBuilder = Shopware()->Models()->getDBALQueryBuilder();

        $subQueryBuilder->select($this->getSelectWithExpression($definition, $subQueryAlias))
            ->from($this->getTableName(), $subQueryAlias)
            ->where('product.id = ' . $subQueryAlias . '.articleID');

        $queryBuilder->addSelect('(' . $subQueryBuilder->getSQL() . ') AS ' . $alias . '_' . $definition->getFieldName());

        return $alias;
    }
}
