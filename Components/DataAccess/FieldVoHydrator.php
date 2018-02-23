<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\DataAccess;

use Shopware\SwagDefaultSort\Components\DataAccess\Translate\TranslateFilterChain;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

/**
 * Class FieldVoHydrator.
 *
 * Factory creating ValueObjects from a DefinitionCollection, or SortDefinition
 */
class FieldVoHydrator
{
    /**
     * @var TranslateFilterChain
     */
    private $translateFilter;

    /**
     * @param TranslateFilterChain $translateFilter
     */
    public function __construct(TranslateFilterChain $translateFilter)
    {
        $this->translateFilter = $translateFilter;
    }

    /**
     * @param DefinitionCollection $definitions
     *
     * @return FieldVo[]
     */
    public function createFieldVos(DefinitionCollection $definitions)
    {
        $ret = [];
        foreach ($definitions as $definition) {
            $ret[] = $this->createFieldVo($definition);
        }

        return $ret;
    }

    /**
     * @param AbstractSortDefinition $definition
     *
     * @return FieldVo
     */
    public function createFieldVo(AbstractSortDefinition $definition)
    {
        return new FieldVo(
            $definition,
            $this->translateFilter
        );
    }
}
