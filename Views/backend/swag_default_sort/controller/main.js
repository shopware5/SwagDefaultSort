
//{block name="backend/swag_default_sort/controller/main"}
/**
 * Main Controller: ALL Handlers are here
 */
Ext.define('Shopware.apps.SwagDefaultSort.controller.Main', {
    extend: 'Enlight.app.Controller',

    init: function() {
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

    getWindow: function() {
        var windowQueryResult = Ext.ComponentQuery.query('swag-default-sort-list-window');

        if(!windowQueryResult) {
            return false;
        }

        return windowQueryResult[0];
    },

    /**
     * Init controller listeners
     */
    registerEventHandlers: function() {
        var me = this;

        this.control({
            'swag-default-sort-listing-grid-rules gridview': {
                'drop': me.onDropSteRuleOrder
            },
            'swag-default-sort-listing-grid-rules': {
                'rule-add-item': me.onAddRuleStartEditing,
                'edit': me.syncRuleStore
            },
            'swag-default-sort-listing-grid-categories': {
                'viewready': me.onCategoryGridInitSelectFirstRow,
                'catgeory-selection-change': me.onCategorySelectChangeRuleFilter,
                'categorypath-add-item': me.onAddCategoryStartEditing,
                'edit': me.onCategoryEditSyncRecordData
            }
        });

        this.getWindow().stores.field.addListener('load', me.onLoadRepaintRuleGrid, me);
        this.getWindow().stores.table.addListener('load', me.onLoadRepaintRuleGrid, me);
    },

    onLoadRepaintRuleGrid: function(store, records) {
        this.getRuleGrid().getView().refresh();
    },

    /**
     * @param categoryGrid
     * @param record
     */
    onAddCategoryStartEditing: function(categoryGrid, record) {
        categoryGrid.store.add(record);
        categoryGrid.getRowEditingPlugin().startEdit(record, 0);
    },

    /**
     * @param source
     * @param event
     */
    onCategoryEditSyncRecordData: function(source, event) {
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

        this.onCategorySelectChangeRuleFilter([displayedRecord]);

        this.getRuleGrid().store.data.each(function() {
            this.set('categoryId', newCatId);
        });
        this.syncRuleStore();
    },

    /**
     * @param ruleGrid
     * @param record
     */
    onAddRuleStartEditing: function (ruleGrid, record) {
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

    /**
     * @param node
     * @param data
     * @param overModel
     * @param dropPosition
     */
    onDropSteRuleOrder: function(node, data, overModel, dropPosition) {
        var ruleGridView = this.getRuleGrid().getView();
        var records = ruleGridView.getRecords(ruleGridView.getNodes());

        for(var i = 0; i < records.length; i++) {
            records[i].set('sortOrder', i);
        }

        this.syncRuleStore();
    },

    syncRuleStore: function() {
        var ruleGrid = this.getRuleGrid();
        var categoryGrid = this.getCategoryGrid();
        var ruleGridStore = ruleGrid.store;

        //IMPORTANT: The sync method will never call callbacks with empty changesets
        if(!ruleGridStore.getModifiedRecords().length) {
            return;
        }

        ruleGrid.setLoading(true);
        categoryGrid.setLoading(true);

        ruleGridStore.sync({
            callback: function() {
                ruleGrid.setLoading(false);
                categoryGrid.setLoading(false);
            }
        });
    },

    onCategoryGridInitSelectFirstRow: function(categoryGrid){
        var ruleAddButton = this.getRuleGrid().addButton;

        ruleAddButton.enable();
        if(!categoryGrid.store.data.items.length) {
            ruleAddButton.disable(true);
            return;
        }

        categoryGrid.selModel.doSelect(categoryGrid.store.data.items[0]);
    },

    /**
     * Filter sules based on currently selected category
     *
     * @param selection
     */
    onCategorySelectChangeRuleFilter: function(selection) {
        var filterCatId = 0;
        var ruleGrid = this.getRuleGrid();
        var ruleAddButton = ruleGrid.addButton;

        ruleAddButton.disable(true);
        if(selection.length === 1 && selection[0].get('catId')) {
            filterCatId = selection[0].get('catId');
            ruleAddButton.enable();
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
//{/block}