<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

/**
 * Interface GroupExpressionConditionInterface.
 *
 * Optional: Implement this so that the field will use a method
 */
interface ExpressionConditionInterface
{
    const GROUPFKT_COUNT = 'COUNT';
    const GROUPFKT_MAX = 'MAX';
    const GROUPFKT_MIN = 'MIN';
    const GROUPFKT_SUM = 'SUM';

    /**
     * @return string
     */
    public function getGroupingFunction();
}
