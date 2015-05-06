<?php

namespace Shopware\SwagDefaultSort\Components\DataAccess;

/**
 * Class TranslateFilter.
 *
 * From configUid -> readable string
 */
class TranslateFilter
{
    /**
     * @var \Enlight_Components_Snippet_Namespace
     */
    private $snippedNamespace;

    public function __construct(\Enlight_Components_Snippet_Namespace $snippetNamespace)
    {
        $this->snippedNamespace = $snippetNamespace;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function filter($value)
    {
        $ret = $this->snippedNamespace->get(
            $this->getSanitizedValue($value)
        );

        if (!$ret) {
            return $this->getFallbackLabel($value);
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

    /**
     * @param string $value
     *
     * @return string
     */
    private function getFallbackLabel($value)
    {
        $parts = explode('::', $value);

        return end($parts);
    }
}
