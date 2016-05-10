<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components.
 */
class Shopware_Controllers_Backend_SwagDefaultSortCategory extends Shopware_Controllers_Backend_Application
{
    protected $model = 'Shopware\Models\Category\Category';
    protected $alias = 'category';

    /**
     * Realy dirty, but the structure provided by the parent does not leave me another option, when this controller gets refactored to multiple objects there will be better solutions.
     *
     * @var bool
     */
    private $addRuleConstraint;

    /**
     * {@inheritdoc}
     */
    protected function getListQuery()
    {
        $builder = parent::getListQuery();

        if ($this->addRuleConstraint) {
            $ids = Shopware()->Models()->getDBALQueryBuilder()
                ->select('DISTINCT rule.category_id')
                ->from('s_plugin_swag_default_sort_rule', 'rule')
                ->execute()
                ->fetchAll(PDO::FETCH_COLUMN, 0);

            $builder->where('category.id IN (:ruleCategoryIds)')
                ->setParameter(
                    ':ruleCategoryIds',
                    $ids,
                    \Doctrine\DBAL\Connection::PARAM_INT_ARRAY

                );
        }

        $builder->orderBy('category.parentId')
            ->addOrderBy('category.position');

        return $builder;
    }

    private function addParentPath(array &$categories)
    {
        $parentPathQuery = Shopware()->Models()->getDBALQueryBuilder()
            ->select('id, category.description AS name')
            ->from('s_categories', 'category', 'id')
            ->where('id IN (:categoryIds)');

        foreach ($categories as &$category) {
            $category['catId'] = $category['id'];
            $category['parentPath'] = [];

            if (!$category['path']) {
                continue;
            }

            $parentIds = explode('|', $category['path']);
            $cleanParentIds = array_reverse(array_filter($parentIds));

            $categoriesRawNames = $parentPathQuery->setParameter(
                    ':categoryIds',
                    $cleanParentIds,
                    \Doctrine\DBAL\Connection::PARAM_INT_ARRAY
                )->execute()
                ->fetchAll(\PDO::FETCH_ASSOC);

            $path = [];

            foreach ($categoriesRawNames as $row) {
                $path[$row['id']] = $row['name'];
            }

            foreach ($cleanParentIds as $id) {
                $category['parentPath'][] = $path[$id];
            }
        }
    }

    protected function getList($offset, $limit, $sort = array(), $filter = array(), array $wholeParams = array())
    {
        $result = parent::getList($offset, $limit, $sort, $filter, $wholeParams);
        $this->addParentPath($result['data']);

        return $result;
    }

    public function createAction()
    {
        throw new Enlight_Controller_Exception('Method not supported', 404);
    }

    public function updateAction()
    {
        throw new Enlight_Controller_Exception('Method not supported', 404);
    }

    public function listAction()
    {
        $this->addRuleConstraint = true;

        $this->View()->assign(
            $this->getList(
                $this->Request()->getParam('start', 0),
                $this->Request()->getParam('limit', 20),
                $this->Request()->getParam('sort', array()),
                $this->Request()->getParam('filter', array()),
                $this->Request()->getParams()
            )
        );
    }

    public function listAllAction()
    {
        $this->addRuleConstraint = false;

        $this->View()->assign(
            $this->getList(
                $this->Request()->getParam('start', 0),
                $this->Request()->getParam('limit', 20),
                $this->Request()->getParam('sort', array()),
                $this->Request()->getParam('filter', array()),
                $this->Request()->getParams()
            )
        );
    }
}
