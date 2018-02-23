<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition\OrderDetails;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class OrderTableLoader implements TableLoaderInterface
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_order_details';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        return [
            new SumOrderAmount($this),
        ];
    }
}
