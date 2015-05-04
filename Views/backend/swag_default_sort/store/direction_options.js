Ext.define('Shopware.apps.SwagDefaultSort.store.DirectionOptions', {

    extend:'Shopware.store.Listing',
    storeId: 'SwagDefaultSortDirectionOptions',

    fields: ['key', 'value'],

    data: [{
        key: 0,
        value: "ASC"
    }, {
        key: 1,
        value: "DESC"
    }],
    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    }
});