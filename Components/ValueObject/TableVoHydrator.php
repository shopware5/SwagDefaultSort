<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;

/**
 * Class TableHydrator
 *
 * TableVO generator
 *
 * @package Shopware\SwagDefaultSort\Components\ValueObject
 */
class TableVoHydrator {

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
     * @param array $tableNames
     * @return TableVO[]
     */
    public function createTableVos(array $tableNames) {
        $ret = [];

        foreach($tableNames as $tableName) {
            $ret[] = $this->createTableVo($tableName);
        }

        return $ret;
    }

    /**
     * @param $tableName
     * @return TableVO
     */
    public function createTableVo($tableName) {
        return new TableVO($tableName, $this->getTranslateFilter());
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