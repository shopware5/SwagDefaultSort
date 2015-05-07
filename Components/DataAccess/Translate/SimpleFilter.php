<?php

namespace Shopware\SwagDefaultSort\Components\DataAccess\Translate;

/**
 * Class SimpleFilter.
 *
 * KJust a proxy for 'Enlight_Components_Snippet_Namespace'
 */
class SimpleFilter implements FilterInterface
{
    /**
     * @var \Enlight_Components_Snippet_Namespace
     */
    private $namespace;

    public function __construct(\Enlight_Components_Snippet_Namespace $namespace)
    {
        $this->namespace = $namespace;
    }

    public function filter($value)
    {
        $ret = $this->namespace->get($value);

        if (!$ret) {
            return $value;
        }

        return $ret;
    }
}
