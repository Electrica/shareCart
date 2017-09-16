shareCart.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'sharecart-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('sharecart') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('sharecart_items'),
                layout: 'anchor',
                items: [{
                    html: _('sharecart_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'sharecart-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    shareCart.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(shareCart.panel.Home, MODx.Panel);
Ext.reg('sharecart-panel-home', shareCart.panel.Home);
