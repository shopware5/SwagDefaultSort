<?php


namespace Shopware\SwagDefaultSort\Components\DataAccess;
use InvalidArgumentException;


/**
 * Class RuleHydrator
 *
 * Factory creating RuleValueObjects from result-sets of DatabaseAdapter
 *
 * @see DatabaseAdapter
 * @package Shopware\SwagDefaultSort\Components\DataAccess
 */
class RuleHydrator
{
    /**
     * @param array $data
     * @return array
     */
    public function createRuleVos(array $data)
    {
        $ret = [];

        foreach ($data as $rawRuleData) {
            $ret[] = $this->createRuleVo($rawRuleData);
        }

        return $ret;
    }

    /**
     * @param array $rawData
     * @return RuleVo
     */
    public function createRuleVo(array $rawData)
    {
        $this->testKeysExists($rawData, [
            'id',
            'sortOrder',
            'definitionUid',
            'descending'
        ]);

        $vo = new RuleVo($rawData['id']);
        $vo->setOrder($rawData['sortOrder']);
        $vo->setDescending($rawData['descending']);
        $vo->setDefinitionUid($rawData['definitionUid']);

        return $vo;
    }

    /**
     * @param array $data
     * @param array $keyNames
     */
    private function testKeysExists(array $data, array $keyNames)
    {
        foreach ($keyNames as $keyName) {
            if (array_key_exists($keyName, $data)) {
                continue;
            }

            throw new InvalidArgumentException('Required key "' . $keyName . '" not found in array');
        }
    }
}