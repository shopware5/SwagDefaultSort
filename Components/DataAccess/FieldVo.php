<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\DataAccess;

use JsonSerializable;
use Shopware\SwagDefaultSort\Components\DataAccess\Translate\TranslateFilterChain;
use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class FieldVo.
 *
 * ValueObject for backend SortDefinition select.
 */
class FieldVo implements JsonSerializable
{
    /**
     * @var AbstractSortDefinition
     */
    private $definition;

    /**
     * @var TranslateFilterChain
     */
    private $translationFilter;

    /**
     * @param AbstractSortDefinition $sortDefinition
     * @param TranslateFilterChain   $translationFilter
     */
    public function __construct(AbstractSortDefinition $sortDefinition, TranslateFilterChain $translationFilter)
    {
        $this->definition = $sortDefinition;
        $this->translationFilter = $translationFilter;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return  (string) $this->definition->getTableName();
    }

    /**
     * @return mixed
     */
    public function getTranslation()
    {
        return $this->translationFilter->filter($this->definition);
    }

    /**
     * @return string
     */
    public function getDefinitionUid()
    {
        return (string) $this->definition->getUniqueIdentifier();
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        try {
            return [
                'tableName' => $this->getTableName(),
                'translation' => $this->getTranslation(),
                'definitionUid' => $this->getDefinitionUid(),
            ];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
