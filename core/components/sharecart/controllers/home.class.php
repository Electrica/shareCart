<?php

/**
 * The home manager controller for shareCart.
 *
 */
class shareCartHomeManagerController extends modExtraManagerController
{
    /** @var shareCart $shareCart */
    public $shareCart;


    /**
     *
     */
    public function initialize()
    {
        $path = $this->modx->getOption('sharecart_core_path', null,
                $this->modx->getOption('core_path') . 'components/sharecart/') . 'model/sharecart/';
        $this->shareCart = $this->modx->getService('sharecart', 'shareCart', $path);
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return array('sharecart:default');
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('sharecart');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->shareCart->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->shareCart->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addJavascript($this->shareCart->config['jsUrl'] . 'mgr/sharecart.js');
        $this->addJavascript($this->shareCart->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->shareCart->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->shareCart->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->shareCart->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->shareCart->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->shareCart->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        shareCart.config = ' . json_encode($this->shareCart->config) . ';
        shareCart.config.connector_url = "' . $this->shareCart->config['connectorUrl'] . '";
        Ext.onReady(function() {
            MODx.load({ xtype: "sharecart-page-home"});
        });
        </script>
        ');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->shareCart->config['templatesPath'] . 'home.tpl';
    }
}