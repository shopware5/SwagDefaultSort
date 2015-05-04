<?php


namespace Shopware\SwagDefaultSort\Bundle\SearchBundle\Sorting;

use Shopware\Bundle\SearchBundle\SortingInterface;

class DefaultSorting implements SortingInterface {

    /**
     * @return string
     */
    public function getName()
    {
        return 'swag-default-sort-default-sorting';
    }
}