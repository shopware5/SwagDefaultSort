<?php


namespace Shopware\SwagDefaultSort\Bundle\SearchBundleDBAL\SortingHandler;


use Shopware\Bundle\SearchBundle\SortingInterface;
use Shopware\Bundle\SearchBundleDBAL\QueryBuilder;
use Shopware\Bundle\SearchBundleDBAL\SortingHandlerInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\ShopContextInterface;
use Shopware\SwagDefaultSort\Bundle\SearchBundle\Sorting\DefaultSorting;

class DefaultSortingHandler implements SortingHandlerInterface {

    /**
     * Checks if the passed sorting can be handled by this class
     * @param SortingInterface $sorting
     * @return bool
     */
    public function supportsSorting(SortingInterface $sorting)
    {
        return ($sorting instanceof DefaultSorting);
    }

    /**
     * Handles the passed sorting object.
     * Extends the passed query builder with the specify sorting.
     * Should use the addOrderBy function, otherwise other sortings would be overwritten.
     *
     * @param SortingInterface $sorting
     * @param QueryBuilder $query
     * @param ShopContextInterface $context
     * @return void
     */
    public function generateSorting(
        SortingInterface $sorting,
        QueryBuilder $query,
        ShopContextInterface $context
    )
    {
        die('JUHEY!');
    }
}