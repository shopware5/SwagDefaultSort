// {namespace name="backend/swagdefaultsort/main"}

// {block name="backend/swag_default_sort/view/list/categories"}
Ext.define('Shopware.apps.SwagDefaultSort.view.list.Categories', {
    extend: 'Shopware.grid.Panel',
    alias: 'widget.swag-default-sort-listing-grid-categories',
    region: 'center',
    rowEditingId: undefined,

    configure: function () {
        var me = this;
        var id = Ext.id();

        return {
            hasOwnController: true,
            editColumn: false,
            deleteColumn: false,
            searchField: false,
            rowEditing: true,
            deleteButton: false,
            columns: {
                catId: {
                    header: '{s name=category_path}{/s}',
                    align: 'left',
                    editor: {
                        xtype: 'combobox',
                        store: 'SwagDefaultSortCategoryPathSelect',
                        width: '100%',
                        anchor: '100%',
                        valueField: 'catId',
                        displayField: 'parentPathString',
                        editable: false,
                        multiSelect: false,
                        forceSelection: true,
                        allowBlank: false,
                        pageSize: 25
                    },
                    renderer: function(value) {
                        if (!value) {
                            return '';
                        }

                        return this.store.findRecord('catId', value).get('parentPathString');
                    }
                }
            },
            controller: Ext.create('Shopware.apps.SwagDefaultSort.controller.CategoryListing', {
                application: me.subApp,
                subApplication: me.subApp,
                subApp: me.subApp,
                $controllerId: id,
                id: id
            })
        };
    },

    /**
     * changed to cingle select
     *
     * { @inheritdoc }
     */
    createSelectionModel: function () {
        var me = this;

        return Ext.create('Ext.selection.CheckboxModel', {
            mode: 'SINGLE',
            listeners: {
                selectionchange: function (selModel, selection) {
                    return me.fireEvent('catgeory-selection-change', selection);
                }
            }
        });
    },
    getRowEditingPlugin: function() {
        return this.rowEditor;
    }
});
// {/block}
