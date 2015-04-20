
Ext.define('Shopware.apps.SwagDefaultSort.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.swag-default-sort-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.SwagDefaultSort.view.detail.Window'
        };
    }
});
