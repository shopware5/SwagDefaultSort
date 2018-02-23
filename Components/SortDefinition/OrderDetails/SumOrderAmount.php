<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

/**
 * Class MaxOrderCount.
 */
class SumOrderAmount extends AbstractSortDefinition implements ExpressionConditionInterface
{
    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'quantity';
    }

    /**
     * @return string
     */
    public function getGroupingFunction()
    {
        return self::GROUPFKT_SUM;
    }
}
