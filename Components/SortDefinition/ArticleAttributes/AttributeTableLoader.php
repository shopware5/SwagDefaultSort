<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition\ArticleAttributes;

use Shopware\SwagDefaultSort\Components\ORMReflector\ORMReflector;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\GenericDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\TableLoaderInterface;

class AttributeTableLoader implements TableLoaderInterface
{
    private $blacklist = [
        'id',
        'articleID',
        'articledetailsID',
    ];

    /**
     * @var ORMReflector
     */
    private $inflector;

    public function __construct(ORMReflector $inflector)
    {
        $this->inflector = $inflector;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 's_articles_attributes';
    }

    /**
     * @return AbstractSortDefinition[]
     */
    public function createDefinitions()
    {
        $inflectionResult = $this->inflector->getTable($this->getTableName());
        $ret = [];

        foreach ($inflectionResult->getFieldNames() as $fieldName) {
            if (in_array($fieldName, $this->blacklist)) {
                continue;
            }

            $ret[] = new GenericDefinition($fieldName, $this);
        }

        return $ret;
    }
}
