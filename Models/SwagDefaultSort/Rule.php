<?php

namespace   Shopware\CustomModels\SwagDefaultSort;
use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping AS ORM;
use Shopware\Models\Category\Category;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="s_plugin_default_sort_rule", indexes={@ORM\Index(name="s_plugin_default_sort_rule_sort_category", columns={"category_id", "sort"})})
 * @ORM\Entity(repositoryClass="Repository")
 */
class Rule extends ModelEntity
{
    /**
     * Primary Key - autoincrement value
     *
     * @var integer $id
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
     * @Assert\Length(max=255)
     *
     * @ORM\Column(name="table_name", type="string", length=255, nullable=false)
     */
    private $tableName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @ORM\Column(name="field_name", type="string", length=255, nullable=false)
     */
    private $fieldName;

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
     * @ORM\Column(name="descending", type="boolean", nullable=false, options={"default"="0"})
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
     * @Assert\Length(max=255)
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
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     * @return $this
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
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
     * @param int $descending
     * @return $this
     */
    public function setDescending($descending)
    {
        $this->descending = $descending;

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
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @param string $fieldName
     * @return $this
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }


}
