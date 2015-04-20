
Ext.define('Shopware.apps.SwagDefaultSort.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.swag-default-sort-list-window',
    height: 450,
    title : '{s name=window_title}SwagDefaultSort listing{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.SwagDefaultSort.view.list.List',
            listingStore: 'Shopware.apps.SwagDefaultSort.store.Main'
        };
    }
});