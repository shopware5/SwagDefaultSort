<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace   Shopware\CustomModels\SwagDefaultSort;

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Models\Category\Category;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="s_plugin_swag_default_sort_rule", indexes={@ORM\Index(name="s_plugin_default_sort_rule_sort_category", columns={"category_id", "sort"})})
 * @ORM\Entity(repositoryClass="Repository")
 */
class Rule extends ModelEntity implements \JsonSerializable
{
    /**
     * Primary Key - autoincrement value.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @ORM\Column(name="definition_uid", type="string", nullable=false)
     */
    private $definitionUid;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     *
     * @ORM\Column(name="sort", type="integer")
     */
    private $sortOrder;

    /**
     * @var bool
     *
     * @Assert\Type(type="bool")
     *
     * @ORM\Column(name="descending", type="boolean", options={"default"="0"}, nullable=true)
     */
    private $descending;

    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId;

    /**
     * @var Category
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Category\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     *
     * @return $this
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDescending()
    {
        return $this->descending;
    }

    /**
     * @param bool $descending
     *
     * @return $this
     */
    public function setDescending($descending = false)
    {
        $this->descending = (bool) $descending;

        return $this;
    }

    /**
     * @return string
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param string $sortOrder
     *
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
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
     *
     * @return $this
     */
    public function setDefinitionUid($definitionUid)
    {
        $this->definitionUid = $definitionUid;

        return $this;
    }

    /**
     * @param $id
     */
    public function setCategoryId($id)
    {
        $this->categoryId = $id;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        //internal PHP problem - no exceptions allowed
        try {
            return [
                'id' => $this->getId(),
                'definitionUid' => $this->getDefinitionUid(),
                'sortOrder' => $this->getSortOrder(),
                'descending' => $this->isDescending(),
                'categoryId' => $this->categoryId,
            ];
        } catch (Exception $e) {
            trigger_error($e->getMessage()."\n".$e->getTraceAsString(), E_USER_ERROR);

            return [];
        }
    }
}
