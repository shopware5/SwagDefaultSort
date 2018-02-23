<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

class GenericDefinition extends AbstractSortDefinition
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @param string               $fieldName
     * @param TableLoaderInterface $tableLoader
     */
    public function __construct($fieldName, TableLoaderInterface $tableLoader)
    {
        parent::__construct($tableLoader);

        $this->fieldName = (string) $fieldName;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }
}
