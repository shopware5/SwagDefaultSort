
Ext.define('Shopware.apps.SwagDefaultSort.store.Main', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'SwagDefaultSort'
        };
    },
    model: 'Shopware.apps.SwagDefaultSort.model.Main'
});