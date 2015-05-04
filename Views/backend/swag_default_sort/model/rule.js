
Ext.define('Shopware.apps.SwagDefaultSort.model.Rule', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'SwagDefaultSort'//,
            //detail: 'Shopware.apps.SwagDefaultSort.view.detail.Container'
        };
    },

    fields: [
        {
            name : 'id',
            type: 'int',
            useNull: true
        },
        {
            name : 'tableName',
            type: 'string',
            useNull: false,
            defaultValue: 's_articles'
        },
        {
            name : 'fieldName',
            type: 'string',
            useNull: false,
            defaultValue: 'id'
        },
        {
            name : 'direction',
            type: 'int',
            useNull: false
        },
        {
            name: 'sortOrder',
            type: 'int'
        },
        {
            name: 'categoryId',
            type: 'int'
        },
    ]
});

