
Ext.define('Shopware.apps.SwagDefaultSort.controller.Main', {
    extend: 'Enlight.app.Controller',

    init: function() {
        //init stores for storeId access
        Ext.create('Shopware.apps.SwagDefaultSort.store.DirectionOptions');
        Ext.create('Shopware.apps.SwagDefaultSort.store.DbTable');
        Ext.create('Shopware.apps.SwagDefaultSort.store.DbField');
        Ext.create('Shopware.apps.SwagDefaultSort.store.CategoryPathSelect');

        this.mainWindow = this.getView('list.Window').create({ }).show();

        this.registerEventHandlers();
    },

    getRuleGrid: function() {
        var ruleGridQueryResult = Ext.ComponentQuery.query('swag-default-sort-listing-grid-rules');

        if(!ruleGridQueryResult) {
            return false;
        }

        return ruleGridQueryResult[0];
    },
    getCategoryGrid: function() {
        var categoryGridQueryResult = Ext.ComponentQuery.query('swag-default-sort-listing-grid-categories');

        if(!categoryGridQueryResult) {
            return false;
        }

        return categoryGridQueryResult[0];
    },

    registerEventHandlers: function() {
        var me = this;

        this.control({
            'swag-default-sort-listing-grid-rules gridview': {
                'drop': me.reorderStoredRules
            },
            'swag-default-sort-listing-grid-rules': {
                'rule-add-item': me.onAddRule,
                'edit': me.syncRuleStore
            },
            'swag-default-sort-listing-grid-categories': {
                'viewready': me.initSelection,
                'catgeory-selection-change': me.filterSelection,
                'categorypath-add-item': me.onAddCategory,
                'edit': me.changeCategories
            }
        });
    },

    onAddCategory: function(categoryGrid, record) {
        categoryGrid.store.add(record);
        categoryGrid.getRowEditingPlugin().startEdit(record, 0);
    },

    changeCategories: function(source, event) {
        var originalCatId = event.originalValues.catId;
        var newCatId = event.newValues.catId;

        if(originalCatId === newCatId) {
            return;
        }

        var pathSelectStore = Ext.getStore('SwagDefaultSortCategoryPathSelect');
        var catStore = this.getCategoryGrid().store;

        //rewrite cat record
        var selectedRecord = pathSelectStore.findRecord('catId', newCatId);
        var displayedRecord = catStore.findRecord('catId', newCatId);
        displayedRecord.set('parentPath', selectedRecord.get('parentPath'));
        displayedRecord.set('name', selectedRecord.get('name'));
        displayedRecord.set('id', selectedRecord.get('catId'));

        //trigger refresh of column, remove dirty flag
        displayedRecord.set('parentPathString', selectedRecord.get('catId'));
        displayedRecord.commit();

        //rewrite rules
        this.getRuleGrid().store.data.each(function() {
            this.set('categoryId', newCatId);
        });
        this.syncRuleStore();
    },

    onAddRule: function (ruleGrid, record) {
        var categoryGrid = this.getCategoryGrid();

        if(!categoryGrid) {
            return;
        }

        var selection = categoryGrid.getSelectionModel().getSelection();

        if(selection.length !== 1) {
            return;
        }

        record.set('categoryId', selection[0].get('id'));
        record.set('sortOrder', ruleGrid.store.getCount());
        ruleGrid.store.add(record);
        this.syncRuleStore();
        ruleGrid.getRowEditingPlugin().startEdit(record, 0);
    },

    reorderStoredRules: function(node, data, overModel, dropPosition) {
        var ruleGridView = this.getRuleGrid().getView();
        var records = ruleGridView.getRecords(ruleGridView.getNodes());

        for(var i = 0; i < records.length; i++) {
            records[i].set('sortOrder', i);
        }

        this.syncRuleStore();
    },

    syncRuleStore: function() {
        this.getRuleGrid().store.sync();
    },

    initSelection: function(categoryGrid){
        if(!categoryGrid.store.data.items.length) {
            return;
        }

        categoryGrid.selModel.doSelect(categoryGrid.store.data.items[0]);
    },

    filterSelection: function(selection) {
        var filterCatId = 0;
        var ruleGridQueryResult = Ext.ComponentQuery.query('swag-default-sort-listing-grid-rules');

        if(!ruleGridQueryResult) {
            return;
        }

        var ruleGrid = ruleGridQueryResult[0];

        if(selection.length === 1) {
            filterCatId = selection[0].get('catId');
        }

        ruleGrid.store.clearFilter(true);
        ruleGrid.store.filter([{
            property: 'categoryId',
            value: filterCatId,
            expression: '=',
            operator: 'AND'
        }]);
    }
});