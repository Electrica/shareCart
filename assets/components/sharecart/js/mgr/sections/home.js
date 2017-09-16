shareCart.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'sharecart-panel-home',
            renderTo: 'sharecart-panel-home-div'
        }]
    });
    shareCart.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(shareCart.page.Home, MODx.Component);
Ext.reg('sharecart-page-home', shareCart.page.Home);