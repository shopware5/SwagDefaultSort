<?php

namespace Shopware\SwagDefaultSort\Components\DataAccess;

use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;
use Shopware_Components_Snippet_Manager;

/**
 * Class FieldVoHydrator.
 *
 * Factory creating ValueObjects from a DefinitionCollection, or SortDefinition
 */
class FieldVoHydrator
{
    const SNIPPET_NAMESPACE = 'backend/swagdefaultsort/fields';

    /**
     * @var TranslateFilter
     */
    private $translateFilter;

    /**
     * @var Shopware_Components_Snippet_Manager
     */
    private $snippetManager;

    /**
     * @param Shopware_Components_Snippet_Manager $snippetManager
     */
    public function __construct(Shopware_Components_Snippet_Manager $snippetManager)
    {
        $this->snippetManager = $snippetManager;
    }

    /**
     * @param DefinitionCollection $definitions
     *
     * @return FieldVo[]
     */
    public function createFieldVos(DefinitionCollection $definitions)
    {
        $ret = [];
        foreach ($definitions as $definition) {
            $ret[] = $this->createFieldVo($definition);
        }

        return $ret;
    }

    /**
     * @param AbstractSortDefinition $definition
     *
     * @return FieldVo
     */
    public function createFieldVo(AbstractSortDefinition $definition)
    {
        return new FieldVo(
            $definition,
            $this->getTranslateFilter()
        );
    }

    /**
     * @return TranslateFilter
     */
    private function getTranslateFilter()
    {
        if (!$this->translateFilter) {
            $this->translateFilter = new TranslateFilter(
                $this->snippetManager->getNamespace(self::SNIPPET_NAMESPACE)
            );
        }

        return $this->translateFilter;
    }
}
