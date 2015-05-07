//{namespace name="backend/swagdefaultsort/main"}

Ext.define('Shopware.apps.SwagDefaultSort.store.DirectionOptions', {

    extend:'Shopware.store.Listing',

    storeId: 'SwagDefaultSortDirectionOptions',

    fields: ['key', 'value'],

    data: [{
        key: 0,
        value: "{s name=ascending}{/s}"
    }, {
        key: 1,
        value: "{s name=descending}{/s}"
    }],

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    }
});