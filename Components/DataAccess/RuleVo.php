<?php


namespace Shopware\SwagDefaultSort\Components\DataAccess;

/**
 * Class RuleVo
 *
 * Representation of s_plugin_swag_default_sort_rule rows, used for frontend requests
 *
 * @package Shopware\SwagDefaultSort\Components\Frontend
 */
class RuleVo
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $order;

    /**
     * @var bool
     */
    private $descending;

    /**
     * @var string
     */
    private $definitionUid;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = (int)$id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return boolean
     */
    public function isDescending()
    {
        return $this->descending;
    }

    /**
     * @param boolean $descending
     */
    public function setDescending($descending)
    {
        $this->descending = $descending;
    }

    /**
     * @return string
     */
    public function getDefinitionUid()
    {
        return $this->definitionUid;
    }

    /**
     * @param string $definitionUid
     */
    public function setDefinitionUid($definitionUid)
    {
        $this->definitionUid = $definitionUid;
    }
}