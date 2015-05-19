<?php

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components.
 */
class Shopware_Controllers_Backend_SwagDefaultSort extends Shopware_Controllers_Backend_Application
{
    protected $model = 'Shopware\CustomModels\SwagDefaultSort\Rule';
    protected $alias = 'rule';

    /**
     * Extend so the foreign key is correctly flagged.
     *
     * @param string $model
     * @param null   $alias
     *
     * @return array
     */
    protected function getModelFields($model, $alias = null)
    {
        $fields = parent::getModelFields($model, $alias);

        $fields['categoryId']['type'] = 'foreignKey';

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    protected function getList($offset, $limit, $sort = array(), $filter = array(), array $wholeParams = array())
    {
        $ret = parent::getList($offset, $limit, $sort, $filter, $wholeParams);

        foreach ($ret['data'] as &$rule) {
            $this->appendTableNameToRule($rule);
        }

        return $ret;
    }

    /**
     * {@inheritdoc}
     */
    public function getDetail($id)
    {
        $ret = parent::getDetail($id);

        if ($ret['success']) {
            $this->appendTableNameToRule($ret['data']);
        }

        return $ret;
    }

    /**
     * @param $rule
     * @throws Exception
     */
    private function appendTableNameToRule(&$rule)
    {
        /** @var \Shopware\SwagDefaultSort\Components\SortDefinition\DefinitionCollection $definitionCollection */
        $definitionCollection = Shopware()->Container()->get('swag_default_sort.definition_collection');
        $rule['tableName'] = $definitionCollection->getDefinition($rule['definitionUid'])->getTableName();
    }


    /**
     * Adds a pseudo format, tp prevent 'LIKE' search for a foreign key.
     *
     * @param string $value
     * @param array  $field
     *
     * @return int|string
     */
    protected function formatSearchValue($value, array $field)
    {
        if ($field['type'] == 'foreignKey') {
            return (int) $value;
        }

        return parent::formatSearchValue($value, $field);
    }

    /**
     * Extended so multi edit is possible.
     */
    public function updateAction()
    {
        $params = $this->Request()->getParams();

        if (isset($params['id'])) {
            $params = [$params];
        }

        $assignment = [];

        foreach ($params as $index => $possibleRecord) {
            if (!is_numeric($index)) {
                continue;
            }

            if (!isset($possibleRecord['id'])) {
                continue;
            }

            $assignment = array_merge(
                $assignment,
                $this->save($possibleRecord)
            );
        }

        $this->View()->assign(
            $assignment
        );
    }

    public function listTablesAction()
    {
        try {
            $tableVos = $this->getTableVos();

            $this->View()->assign([
                'success' => true,
                'data' => $tableVos,
            ]);
        } catch (Exception $e) {
            $this->View()->assign([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public function listFieldsAction()
    {
        try {
            $fields = $this->getFieldVos();

            $this->View()->assign([
                'success' => true,
                'data' => $fields,
            ]);
        } catch (Exception $e) {
            $this->View()->assign([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * @return \Shopware\SwagDefaultSort\Components\DataAccess\TableVo[]
     *
     * @throws Exception
     */
    private function getTableVos()
    {
        return Shopware()->Container()
            ->get('swag_default_sort.table_vo_collection');
    }

    /**
     * @return \Shopware\SwagDefaultSort\Components\DataAccess\FieldVo[]
     *
     * @throws Exception
     */
    private function getFieldVos()
    {
        return Shopware()->Container()
            ->get('swag_default_sort.field_vo_collection');
    }
}
