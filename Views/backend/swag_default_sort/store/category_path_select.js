
//{block name="backend/swag_default_sort/store/category_path_select"}
Ext.define('Shopware.apps.SwagDefaultSort.store.CategoryPathSelect', {
    extend:'Shopware.store.Listing',

    storeId: 'SwagDefaultSortCategoryPathSelect',

    configure: function() {
        return {
            controller: 'SwagDefaultSortCategory',
            /**
             * Model proxy which defines
             * the urls for the CRUD actions.
             */
            proxy: {
                type: 'ajax',
                api: {
                    read: '{url controller="SwagDefaultSortCategory" action="listAll"}'
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
//{/block}