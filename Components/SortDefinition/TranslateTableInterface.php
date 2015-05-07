<?php

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
