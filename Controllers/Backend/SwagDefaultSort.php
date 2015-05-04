<?php

/**
 * Backend controllers extending from Shopware_Controllers_Backend_Application do support the new backend components
 */
class Shopware_Controllers_Backend_SwagDefaultSort extends Shopware_Controllers_Backend_Application
{
    protected $model = 'Shopware\CustomModels\SwagDefaultSort\Rule';
    protected $alias = 'rule';

    public function listInflectionTablesAction() {}

    /**
     * Extend so the foreign key is correctly flagged
     *
     * @param string $model
     * @param null $alias
     * @return array
     */
    protected function getModelFields($model, $alias = null) {
        $fields = parent::getModelFields($model, $alias);

        $fields['categoryId']['type'] = 'foreignKey';

        return $fields;
    }

    /**
     * Adds a pseudo format, tp prevent 'LIKE' search for a foreign key
     *
     * @param string $value
     * @param array $field
     * @return int|string
     */
    protected function formatSearchValue($value, array $field)
    {
        if($field['type'] == 'foreignKey') {
            return (int) $value;
        }

        return parent::formatSearchValue($value, $field);
    }

    /**
     * Extended so multi edit is possible
     */
    public function updateAction()
    {
        $params = $this->Request()->getParams();

        if(isset($params['id'])) {
            $params = [$params];
        }

        $assignment = [];

        foreach($params as $index => $possibleRecord) {
            if(!is_numeric($index)) {
                continue;
            }

            if(!isset($possibleRecord['id'])) {
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

    public function testAction() {
        $details = Shopware()
            ->Models()
            ->getDBALQueryBuilder()
            ->select('det.id')
            ->from('s_articles_details', 'det')
            ->execute()
            ->fetchAll(\PDO::FETCH_COLUMN);

        //prepareQuery
//        $sql = $this->getTestQuery()->getSQL();
//        $stmt = Shopware()->Models()->getConnection()->prepare($sql);
//        $startPrepared = microtime(true);
//        for($i = 0; $i < 50; $i++) {
//            foreach ($details as $id) {
//                $stmt->bindParam(':id', $id);
//                $stmt->execute();
//            }
//        }
//        $diff = microtime(true) - $startPrepared;

        $startNotPrepared = microtime(true);
        for($i = 0; $i < 50; $i++) {
            foreach ($details as $id) {
                $this->getTestQuery()
                    ->setParameter(':id', $id)
                    ->execute();
            }
        }
        $diff = microtime(true) - $startNotPrepared;

        echo '<pre>';
        echo $diff . "\n";
        print_r($details);
        die();





    }

    private function getTestQuery() {
        return Shopware()
            ->Models()
            ->getDBALQueryBuilder()
            ->update('s_articles_details', 'det')
            ->set('det.id', ':id')
            ->where('det.id = :id');
    }
}
