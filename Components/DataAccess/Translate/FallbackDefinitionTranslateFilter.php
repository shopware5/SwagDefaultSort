<?php

namespace Shopware\SwagDefaultSort\Components\DataAccess\Translate;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;

/**
 * Class TranslateFilter.
 *
 * From configUid -> readable string without snippet manager
 */
class FallbackDefinitionTranslateFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        if (!$value instanceof AbstractSortDefinition) {
            throw new \InvalidArgumentException('Unable to generate translation $value of wrong type');
        }

        $parts = explode('::', $value->getUniqueIdentifier());

        return end($parts);
    }
}
