<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;

use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class DatabaseAdapter
 * @package Shopware\SwagDefaultSort\Components\ValueObject
 */
class DatabaseAdapter
{

    const PLUGIN_TABLE_NAME = 's_plugin_swag_default_sort_rule';

    private $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function fetchClosestCategoryIdWithRule($categoryId)
    {
        do {
            $result = $this->queryBuilder
                ->addSelect('category.parent')
                ->addSelect('(SELECT COUNT(*) FROM ' . self::PLUGIN_TABLE_NAME . ' WHERE category_id = category.id) AS hasRules')
                ->from('s_categories', 'category')
                ->where('category.id = :categoryId')
                ->setParameter(':categoryId', $categoryId)
                ->execute()
                ->fetchColumn();

            $categoryId = $result['parent'];

        } while ($categoryId && !$result['hasRules']);

        return $categoryId;
    }

    public function fetchRawData($categoryId)
    {
        $query = $this->queryBuilder
            ->addSelect('rule.id AS id')
            ->addSelect('rule.sort AS sortOrder')
            ->addSelect('rule.definition_uid AS definitionUid')
            ->addSelect('rule.descending AS descending')
            ->from(
                self::PLUGIN_TABLE_NAME,
                'rule'
            )
            ->where('rule.category_id = :requestedCategoryId')
            ->orderBy('rule.sort')
            ->setParameter(':requestedCategoryId', $categoryId);

        $stmt = $query->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}