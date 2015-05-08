
//{block name="backend/swag_default_sort/controller/rule_listing"}
Ext.define('Shopware.apps.SwagDefaultSort.controller.RuleListing', {
    extend: 'Shopware.grid.Controller',

    onAddElement: function() {},

    configure: function() {
        return {
            gridClass: 'Shopware.apps.SwagDefaultSort.view.list.Rules',
            eventAlias: 'rule'
        };
    }

});
//{/block}