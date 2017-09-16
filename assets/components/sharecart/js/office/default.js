Ext.onReady(function () {
    shareCart.config.connector_url = OfficeConfig.actionUrl;

    var grid = new shareCart.panel.Home();
    grid.render('office-sharecart-wrapper');

    var preloader = document.getElementById('office-preloader');
    if (preloader) {
        preloader.parentNode.removeChild(preloader);
    }
});