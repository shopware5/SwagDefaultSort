
window['swag-default-sort-store-in-memory'] = {};

Ext.define('Shopware.apps.SwagDefaultSort.store.CategoryPath', {
    extend:'Shopware.store.Listing',

    storeId: 'SwagDefaultSortCategoryPath',


    configure: function() {
        return {
            controller: 'SwagDefaultSort',

            proxy: {
                type: 'ajax',
                api: {
                    read: '{url controller="SwagDefaultSortCategory" action="list"}'
                },
                reader: {
                    type: 'json',
                    root: 'data',
                    totalProperty: 'total'
                }
            }
        };
    },

    model: 'Shopware.apps.SwagDefaultSort.model.CategoryPath'
});