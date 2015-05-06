<?php


namespace Shopware\SwagDefaultSort\Components\DataAccess;

use Doctrine\DBAL\Connection;

/**
 * Class DatabaseAdapter
 *
 * All DB-Queries go here!
 *
 * @package Shopware\SwagDefaultSort\Components\DataAccess
 */
class DatabaseAdapter
{
    const PLUGIN_TABLE_NAME = 's_plugin_swag_default_sort_rule';

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Warning: This may not be the fastest query depending on the current database layout
     *
     * @param $categoryId
     * @return int|null
     */
    public function fetchClosestCategoryIdWithRule($categoryId)
    {
        do {
            $result = $this->connection
                ->createQueryBuilder()
                ->addSelect('category.parent')
                ->addSelect('(SELECT COUNT(*) FROM ' . self::PLUGIN_TABLE_NAME . ' WHERE category_id = category.id) AS hasRules')
                ->from('s_categories', 'category')
                ->where('category.id = :categoryId')
                ->setParameter(':categoryId', $categoryId)
                ->execute()
                ->fetchColumn();

            if ($result['hasRules']) {
                return $categoryId;
            }

            $categoryId = $result['parent'];

        } while ($categoryId);

        return null;
    }

    /**
     * Selects data, according to the hydrator to create ValueObjects
     *
     * @see RuleVo
     * @see FieldVoHydrator
     * @param $categoryId
     * @return array assoc data
     */
    public function fetchRawData($categoryId)
    {
        $query = $this->connection
            ->createQueryBuilder()
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