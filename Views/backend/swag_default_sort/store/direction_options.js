//{namespace name="backend/swagdefaultsort/main"}

//{block name="backend/swag_default_sort/store/direction_options"}
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
//{/block}