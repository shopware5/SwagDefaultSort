<?php


namespace Shopware\SwagDefaultSort\Components\DataAccess;

/**
 * Class TableHydrator
 *
 * TableVO factory
 *
 * @package Shopware\SwagDefaultSort\Components\DataAccess
 */
class TableVoHydrator
{

    const SNIPPET_NAMESPACE = 'backend/swagdefaultsort/tables';

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
    public function __construct(\Shopware_Components_Snippet_Manager $snippetManager)
    {
        $this->snippetManager = $snippetManager;
    }

    /**
     * @param array $tableNames
     * @return TableVo[]
     */
    public function createTableVos(array $tableNames)
    {
        $ret = [];

        foreach ($tableNames as $tableName) {
            $ret[] = $this->createTableVo($tableName);
        }

        return $ret;
    }

    /**
     * @param $tableName
     * @return TableVo
     */
    public function createTableVo($tableName)
    {
        return new TableVo($tableName, $this->getTranslateFilter());
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