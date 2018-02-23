<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\QueryExtender\OrderByProvider;

use Shopware\SwagDefaultSort\Components\SortDefinition\ExpressionConditionInterface;

/**
 * Class ExpressionConditionFilter.
 *
 * Cahnges values so that the generated data from AbstractExpressionJoinProvider matches
 */
class ExpressionConditionFilter extends AbstractOrderByFilter
{
    /**
     * @param string $currentValue
     *
     * @return string filtered value
     */
    public function filterSort($currentValue)
    {
        $definition = $this->getDefinition();

        if (!$definition instanceof ExpressionConditionInterface) {
            return $currentValue;
        }

        return str_replace('.', '_', $currentValue);
    }

    /**
     * @param string $currentValue
     *
     * @return string filtered value
     */
    public function filterOrder($currentValue)
    {
        return $currentValue;
    }
}
