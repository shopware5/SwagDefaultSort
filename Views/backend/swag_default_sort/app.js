
Ext.define('Shopware.apps.SwagDefaultSort', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.SwagDefaultSort',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.List',

        'detail.Container',
        'detail.Window'
    ],

    models: [ 'Main' ],
    stores: [ 'Main' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});