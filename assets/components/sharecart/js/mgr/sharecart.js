var shareCart = function (config) {
    config = config || {};
    shareCart.superclass.constructor.call(this, config);
};
Ext.extend(shareCart, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('sharecart', shareCart);

shareCart = new shareCart();