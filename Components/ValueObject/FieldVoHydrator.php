<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;


use Shopware\SwagDefaultSort\Components\SortDefinition\AbstractSortDefinition;
use Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection;

class FieldVoHydrator {

    const SNIPPET_NAMESPACE = 'backend/swagdefaultsort/fields';

    /**
     * @var TranslateFilter
     */
    private $translateFilter;

    /**
     * @var \Shopware_Components_Snippet_Manager
     */
    private $snippetManager;

    /**
     * @param \Shopware_Components_Snippet_Manager $snippetManager
     */
    public function __construct(\Shopware_Components_Snippet_Manager $snippetManager) {
        $this->snippetManager = $snippetManager;
    }


    /**
     * @param DefinitionCollection $definitions
     * @return FieldVO[]
     */
    public function createFieldVos(DefinitionCollection $definitions) {
        $ret = [];
        foreach($definitions as $definition) {
            $ret[] = $this->createFieldVo($definition);
        }

        return $ret;
    }

    /**
     * @param AbstractSortDefinition $definition
     * @return FieldVO
     */
    public function createFieldVo(AbstractSortDefinition $definition) {
        return new FieldVO(
            $definition,
            $this->getTranslateFilter()
        );
    }

    /**
     * @return TranslateFilter
     */
    private function getTranslateFilter() {
        if(!$this->translateFilter) {
            $this->translateFilter = new TranslateFilter(
                $this->snippetManager->getNamespace(self::SNIPPET_NAMESPACE)
            );
        }

        return $this->translateFilter;
    }
}