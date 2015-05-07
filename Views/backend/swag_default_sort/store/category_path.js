
window['swag-default-sort-store-in-memory'] = {};

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