//{namespace name="backend/swagdefaultsort/main"}

//{block name="backend/swag_default_sort/view/list/window"}
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

    iconCls: 'sprite-sort',

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
            categories: Ext.create('Shopware.apps.SwagDefaultSort.store.CategoryPath').load(),
            directionOptions: Ext.create('Shopware.apps.SwagDefaultSort.store.DirectionOptions'),
            table: Ext.create('Shopware.apps.SwagDefaultSort.store.DbTable').load(),
            field: Ext.create('Shopware.apps.SwagDefaultSort.store.DbField').load(),
            categoryPathSelect: Ext.create('Shopware.apps.SwagDefaultSort.store.CategoryPathSelect')
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
            title: '{s name=rules}{/s}',
            iconCls: 'sprite-sort',
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
            title: '{s name=categories}{/s}',
            iconCls: 'article--categories',
            region: 'west',
            store: me.stores.categories,
            flex: 1,
            subApp: me.subApp,
            listeners: {

            }
        });
        return me.gridPanels.categories;
    }
});
//{/block}