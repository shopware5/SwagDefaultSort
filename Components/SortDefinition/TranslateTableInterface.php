<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shopware\SwagDefaultSort\Components\SortDefinition;

/**
 * Interface TranslateTableInterface.
 *
 * Presets for a better translation
 *
 * @see FormTableDefinitionFilter
 */
interface TranslateTableInterface
{
    /**
     * @return string
     */
    public function getSnippetNamespace();

    /**
     * @return mixed
     */
    public function getSnippetPrefix();
}
