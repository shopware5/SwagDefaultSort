<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Shopware\SwagDefaultSort\Components\ORMReflector;

use ArrayIterator;
use InvalidArgumentException;

/**
 * Class Map.
 *
 * Map + reverse map for orm field <-> db field mapping
 */
class Map
{
    /**
     * @var string
     */
    private $tableName;

    /**
     * @var array
     */
    private $dbValues = [];

    /**
     * @var array
     */
    private $ormValues = [];

    /**
     * @var array
     */
    private $ormMap = [];

    /**
     * @var array
     */
    private $dbMap = [];

    /**
     * @param $tableName
     */
    public function __construct($tableName)
    {
        if (!$tableName) {
            throw new InvalidArgumentException('Missing required param $tableName');
        }

        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param $dbValue
     * @param $ormValue
     *
     * @return $this
     */
    public function add($dbValue, $ormValue)
    {
        if (!$dbValue) {
            throw new InvalidArgumentException('Missing required param $dbValue');
        }

        if (!$ormValue) {
            throw new InvalidArgumentException('Missing required param $ormValue');
        }

        $this->dbValues[] = $dbValue;
        $this->ormValues[] = $ormValue;

        $dbIndex = count($this->dbValues) - 1;
        $ormIndex = count($this->ormValues) - 1;

        $this->ormMap[$dbValue] = $ormIndex;
        $this->dbMap[$ormValue] = $dbIndex;

        return $this;
    }

    /**
     * @param $dbValue
     *
     * @return mixed
     */
    public function getOrmValue($dbValue)
    {
        if (!isset($this->ormMap[$dbValue])) {
            throw new InvalidArgumentException('"'.$dbValue.'" not mapped');
        }

        return $this->ormValues[$this->ormMap[$dbValue]];
    }

    /**
     * @param $ormValue
     *
     * @return mixed
     */
    public function getDbValue($ormValue)
    {
        if (!isset($this->dbMap[$ormValue])) {
            throw new InvalidArgumentException('"'.$ormValue.'" not mapped');
        }

        return $this->dbValues[$this->dbMap[$ormValue]];
    }

    /**
     * [
     *  $dbValue => $ormValue
     * ].
     *
     * @return ArrayIterator
     */
    public function getOrmIterator()
    {
        $map = [];

        foreach ($this->ormValues as $ormValue) {
            $map[$this->getDbValue($ormValue)] = $ormValue;
        }

        return new ArrayIterator($map);
    }

    /**
     * [
     *  $ormValue => $dbValue
     * ].
     *
     * @return ArrayIterator
     */
    public function getDbIterator()
    {
        $map = [];

        foreach ($this->dbValues as $dbValue) {
            $map[$this->getOrmValue($dbValue)] = $dbValue;
        }

        return new ArrayIterator($map);
    }
}
