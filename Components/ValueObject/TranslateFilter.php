<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;


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

    public function filter($value)
    {
        $ret = $this->snippedNamespace->get($value);

        return $ret ? $ret : $value;
    }

}