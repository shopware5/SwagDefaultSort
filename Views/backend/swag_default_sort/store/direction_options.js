// {namespace name="backend/swagdefaultsort/main"}

// {block name="backend/swag_default_sort/store/direction_options"}
Ext.define('Shopware.apps.SwagDefaultSort.store.DirectionOptions', {

    extend: 'Shopware.store.Listing',

    storeId: 'SwagDefaultSortDirectionOptions',

    fields: ['key', 'value'],

    data: [{
        key: false,
        value: '{s name=ascending}{/s}'
    }, {
        key: true,
        value: '{s name=descending}{/s}'
    }],

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    }
});
// {/block}
