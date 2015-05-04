<?php


namespace Shopware\SwagDefaultSort\Components\ValueObject;


class RuleHydrator
{

    public function createRuleVos(array $data)
    {
        $ret = [];

        foreach ($data as $rawRuleData) {
            $ret[] = $this->createRuleVo($rawRuleData);
        }

        return $ret;
    }

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

    private function testKeysExists(array $data, array $keyNames)
    {
        foreach ($keyNames as $keyName) {
            if (array_key_exists($keyName, $data)) {
                continue;
            }

            throw new \InvalidArgumentException('Required key "' . $keyName . '" not found in array');
        }
    }
}