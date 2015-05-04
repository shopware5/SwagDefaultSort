<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;


class TranslateFilter
{

    /**
     * @var \Enlight_Components_Snippet_Namespace
     */
    private $snippedNamespace;

    /**
     * @var null|string
     */
    private $prefix;

    public function __construct(\Enlight_Components_Snippet_Namespace $snippetNamespace, $prefix = null)
    {
        $this->snippedNamespace = $snippetNamespace;
        $this->prefix = (string)$prefix;
    }

    public function filter($value)
    {
        return $this->snippedNamespace->get($this->prefix . $value);
    }

}