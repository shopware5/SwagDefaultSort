//{namespace name="backend/swagdefaultsort/main"}

//{block name="backend/swag_default_sort/view/list/rules"}
Ext.define('Shopware.apps.SwagDefaultSort.view.list.Rules', {

    extend: 'Shopware.grid.Panel',

    alias: 'widget.swag-default-sort-listing-grid-rules',

    region: 'center',

    itemId: 'SwagDefaultSortRuleGrid',

    sortableColumns: false,

    viewConfig: {
        plugins: [
            {
                ptype: 'gridviewdragdrop',
                dragText: 'SORT'
            }
        ]
    },

    configure: function () {
        var me = this;
        var id = Ext.id();

        return {
            hasOwnController: true,
            searchField: false,
            editColumn: false,
            rowEditing: true,
            controller: Ext.create('Shopware.apps.SwagDefaultSort.controller.RuleListing', {
                application: me.subApp,
                subApplication: me.subApp,
                subApp: me.subApp,
                $controllerId: id,
                id: id
            }),
            columns: {
                tableName: {
                    header: '{s name=component_name}{/s}',
                    groupable: false,
                    renderer: function(value) {
                        if(!value) {
                            return '';
                        }

                        var record = Ext.getStore('SwagDefaultSortDbTable').findRecord('tableName', value);

                        if(!record) {
                            return value;
                        }


                        return record.get('translation');
                    },
                    editor: {
                        xtype: 'combo',
                        triggerAction: 'all',
                        width: '100%',
                        anchor: '100%',
                        store: 'SwagDefaultSortDbTable',
                        queryMode: 'local',
                        valueField:'tableName',
                        displayField: 'translation',
                        editable: false,
                        multiSelect: false,
                        forceSelection : true,
                        allowBlank: false,
                        listeners: {
                            select: function(comboBox, selection) {
                                var fieldElement = comboBox.ownerCt.getForm().findField('definitionUid');

                                fieldElement.suspendCheckChange++;
                                fieldElement.clearValue();
                                fieldElement.suspendCheckChange--;
                            }
                        }
                    }
                },
                definitionUid: {
                    header: '{s name=field_name}{/s}',
                    groupable: false,
                    renderer: function(value, metaData, record) {
                        if(!value) {
                            return '';
                        }

                        var dbFieldStore = Ext.getStore('SwagDefaultSortDbField');
                        dbFieldStore.clearFilter(true);

                        var fieldRecord = dbFieldStore.findRecord('definitionUid', value);

                        if(!fieldRecord) {
                            return value;
                        }

                        return fieldRecord.get('translation');
                    },
                    editor: {
                        xtype: 'combo',
                        triggerAction: 'all',
                        width: '100%',
                        anchor: '100%',
                        store: 'SwagDefaultSortDbField',
                        valueField:'definitionUid',
                        displayField: 'translation',
                        queryMode: 'local',
                        editable: false,
                        multiSelect: false,
                        forceSelection : true,
                        allowBlank: false,
                        listeners: {
                            beforerender: function() {
                                me.store.clearFilter(true);
                            },
                            expand: function(me) {
                                var tableElement = me.ownerCt.getForm().findField('tableName');
                                var value = tableElement.getValue();

                                //no error message on auto change
                                me.suspendCheckChange++;

                                me.store.clearFilter(true);
                                if(!value) {
                                    me.store.filterBy(function() {
                                        return false;
                                    });

                                    me.suspendCheckChange--;
                                    return;
                                }

                                me.store.filterBy(function(field) {
                                    return value == field.get('tableName');
                                });

                                me.suspendCheckChange--;
                            }
                        }
                    }
                },
                descending: {
                    header: '{s name=direction}{/s}',
                    groupable: false,
                    renderer: function(value) {
                        if(!Ext.isBoolean(value)) {
                            return '';
                        }

                        return Ext.getStore('SwagDefaultSortDirectionOptions').findRecord('key', value).get('value');
                    },
                    editor: {
                        xtype: 'combo',
                        triggerAction: 'all',
                        width: '100%',
                        anchor: '100%',
                        store: 'SwagDefaultSortDirectionOptions',
                        queryMode: 'local',
                        valueField:'key',
                        displayField:'value',
                        editable: false,
                        multiSelect: false,
                        forceSelection : true
                    }

                }
            }
        };
    },
    getRowEditingPlugin: function() {
        return this.rowEditor;
    },
    getDragAndDropPlugin: function() {
        return this.dndSorter;
    }

});
//{/block}
