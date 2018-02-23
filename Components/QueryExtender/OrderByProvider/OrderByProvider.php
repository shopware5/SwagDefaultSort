<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;

use Shopware\SwagDefaultSort\Components\DataAccess\RuleVo;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class OrderByProvider.
 *
 * Provide the base order by conditions
 */
class OrderByProvider
{
    const ORDER_ASC = 'ASC';

    const ORDER_DESC = 'DESC';

    /**
     * Info: Naming comes from DBALQuery Builder.
     *
     * @param $alias
     * @param AbstractSortDefinition $definition
     *
     * @return string
     */
    public function getSort(
        $alias,
        AbstractSortDefinition $definition
    ) {
        $field = $alias . '.' . $definition->getFieldName();

        return $field;
    }

    /**
     * Info: Naming comes from DBALQuery Builder.
     *
     * @param RuleVo $rule
     *
     * @return string
     */
    public function getOrder(RuleVo $rule)
    {
        return $rule->isDescending() ? self::ORDER_DESC : self::ORDER_ASC;
    }
}
