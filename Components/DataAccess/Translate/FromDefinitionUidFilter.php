<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\DataAccess\Translate;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class TranslateFilter.
 *
 * From configUid -> readable string with snippet namespace
 */
class FromDefinitionUidFilter implements FilterInterface
{
    /**
     * @var \Enlight_Components_Snippet_Namespace
     */
    private $snippetNamespace;

    /**
     * @param \Enlight_Components_Snippet_Namespace $snippetNamespace
     */
    public function __construct(\Enlight_Components_Snippet_Namespace $snippetNamespace)
    {
        $this->snippetNamespace = $snippetNamespace;
    }

    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        if (!$value instanceof AbstractSortDefinition) {
            throw new \InvalidArgumentException('Unable to generate translation $value of wrong type');
        }

        $ret = $this->snippetNamespace->get(
            $this->getSanitizedValue($value->getUniqueIdentifier())
        );

        if (!$ret) {
            return $value;
        }

        return $ret;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private function getSanitizedValue($value)
    {
        return strtolower(str_replace('::', '_', $value));
    }
}
