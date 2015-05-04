
Ext.define('Shopware.apps.SwagDefaultSort.controller.CategoryListing', {
    extend: 'Shopware.grid.Controller',

    onAddElement: function() {},

    configure: function() {
        return {
            gridClass: 'Shopware.apps.SwagDefaultSort.view.list.Categories',
            eventAlias: 'category'
        };
    }

});