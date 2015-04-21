<?php

namespace   Shopware\CustomModels\SwagDefaultSort;
use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping AS ORM;
use Shopware\Models\Category\Category;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="s_plugin_default_sort_rule", indexes={@ORM\Index(name="s_plugin_default_sort_rule_sort_category", columns="category_id, sort"})
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
     * @var string $name
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @ORM\Column(name="table_name", type="string", length="255", nullable=false)
     */
    private $tableName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     * @Assert\Length(max=255)
     *
     * @ORM\Column(name="field_name", type="string", length="255", nullable=false)
     */
    private $fieldName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     *
     * @ORM\Column(name="sort", type="int")
     */
    private $sortOrder;

    /**
     * @var bool
     *
     * @Assert\Type(type="bool")
     *
     * @ORM\Column(name="descending", type="boolean", default="false", nullable=false)
     */
    private $descending;

    /**
     * @var Category
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     * @ORM\ManyToOne(targetEntity="Category")
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
     * return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name string
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * @return int
     */
    public function getDescending()
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
