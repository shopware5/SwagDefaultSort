<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition\Votes;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

class SumPoints extends AbstractSortDefinition implements ExpressionConditionInterface
{
    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'points';
    }

    /**
     * @return string
     */
    public function getGroupingFunction()
    {
        return self::GROUPFKT_SUM;
    }
}
