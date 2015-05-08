
//{block name="backend/swag_default_sort/app"}
Ext.define('Shopware.apps.SwagDefaultSort', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.SwagDefaultSort',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [
        'Main',
        'RuleListing',
        'CategoryListing'
    ],

    views: [
        'list.Window',
        'list.Rules',
        'list.Categories'
    ],

    models: [
        'Rule',
        'CategoryPath',
        'DbTable',
        'DbField'
    ],

    stores: [
        'Rule',
        'CategoryPath',
        'DirectionOptions',
        'DbTable',
        'DbField'
    ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});
//{/block}