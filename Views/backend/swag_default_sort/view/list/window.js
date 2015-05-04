
Ext.define('Shopware.apps.SwagDefaultSort.view.list.Window', {
    extend: 'Enlight.app.Window',

    mixins: {
        helper: 'Shopware.model.Helper'
    },

    layout: 'border',

    defaults: {
        collapsible: true,
        split: true
    },

    stores: {},

    width: 990,
    height: 450,

    alias: 'widget.swag-default-sort-list-window',

    title : '{s name=window_title}SwagDefaultSort listing{/s}',


    initComponent: function () {
        this.gridPanels = {};
        this.stores = this.createStores();
        this.items = this.createItems();

        this.callParent(arguments);
    },

    createStores: function() {
        return {
            listing: Ext.create('Shopware.apps.SwagDefaultSort.store.Rule').load(),
            categories: Ext.create('Shopware.apps.SwagDefaultSort.store.CategoryPath').load()
        };
    },

    createItems: function () {
        var me = this, items = [];

        items.push(me.createCategoryGridPannel());
        items.push(me.createItemGridPanel());

        return items;
    },

    createItemGridPanel: function () {
        var me = this;

        me.gridPanels.listing = Ext.create('Shopware.apps.SwagDefaultSort.view.list.Rules', {
            title: 'items',
            region: 'center',
            store: me.stores.listing,
            flex: 1,
            subApp: me.subApp
        });


        return me.gridPanels.listing;
    },

    createCategoryGridPannel: function () {
        var me = this;

        me.gridPanels.categories = Ext.create('Shopware.apps.SwagDefaultSort.view.list.Categories', {
            title: 'Katgorien',
            region: 'west',
            store: me.stores.categories,
            flex: 1,
            subApp: me.subApp,
            listeners: {

            }
        });
        return me.gridPanels.categories;
    },

    getRulesPanel: function() {
        return this.gridPanels.listing;
    }



});