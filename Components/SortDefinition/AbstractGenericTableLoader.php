<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

abstract class AbstractGenericTableLoader implements TableLoaderInterface
{
    /**
     * @return array mapped field names
     */
    abstract public function getMappedFieldNames();

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        $ret = [];

        foreach ($this->getMappedFieldNames() as $fieldName) {
            $ret[] = new GenericDefinition($fieldName, $this);
        }

        return $ret;
    }
}
