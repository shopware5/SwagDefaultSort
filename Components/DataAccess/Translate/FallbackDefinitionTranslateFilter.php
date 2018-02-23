<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
