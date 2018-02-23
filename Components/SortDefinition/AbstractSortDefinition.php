<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

/**
 * Interface ConditionInterface.
 *
 * A single Type, for frontend performance we use plain sql
 */
abstract class AbstractSortDefinition
{
    private $table;

    public function __construct(TableLoaderInterface $table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->getTable()->getTableName();
    }

    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return string
     */
    abstract public function getFieldName();

    /**
     * @return string
     */
    public function getUniqueIdentifier()
    {
        $insertion = '';

        if ($this instanceof ExpressionConditionInterface) {
            $insertion = $this->getGroupingFunction() . '::';
        }

        return $this->getTableName() . '::' . $insertion . $this->getFieldName();
    }
}
