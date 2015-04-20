
Ext.define('Shopware.apps.SwagDefaultSort.model.Main', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'SwagDefaultSort',
            detail: 'Shopware.apps.SwagDefaultSort.view.detail.Container'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'name', type: 'string', useNull: false }
    ]
});

