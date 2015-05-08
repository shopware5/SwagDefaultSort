

//{block name="backend/swag_default_sort/store/category_path"}
Ext.define('Shopware.apps.SwagDefaultSort.store.CategoryPath', {
    extend:'Shopware.store.Listing',

    storeId: 'SwagDefaultSortCategoryPath',


    configure: function() {
        return {
            controller: 'SwagDefaultSortCategory'
        };
    },

    model: 'Shopware.apps.SwagDefaultSort.model.CategoryPath'
});
//{/block}