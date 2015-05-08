
//{block name="backend/swag_default_sort/store/db_table"}
Ext.define('Shopware.apps.SwagDefaultSort.store.DbTable', {
    extend:'Shopware.store.Listing',

    storeId: 'SwagDefaultSortDbTable',

    /**
     * If data is not specified, and if autoLoad is true or an Object,
     * this store's load method is automatically called after creation.
     * If the value of autoLoad is an Object, this Object will be passed to the store's load method.
     */
    autoLoad: false,

    /**
     * True to defer any sorting operation to the server. If false, sorting is done locally on the client.
     * @type { boolean }
     */
    remoteSort: false,

    /**
     * True to defer any filtering operation to the server. If false, filtering is done locally on the client.
     * @type { boolean }
     */
    remoteFilter: false,

    configure: function() {
        return {
            controller: 'SwagDefaultSort',
            proxy: {
                type: 'ajax',
                getParams: Ext.emptyFn,
                api: {
                    read: '{url controller="SwagDefaultSort" action="listTables"}'
                },
                reader: {
                    type: 'json',
                    root: 'data',
                    totalProperty: 'total'
                }
            }
        };
    },

    model: 'Shopware.apps.SwagDefaultSort.model.DbTable'
});
//{/block}