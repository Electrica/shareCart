<?php

class shareCart
{
    /** @var modX $modx */
    public $modx;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('sharecart_core_path', $config,
            $this->modx->getOption('core_path') . 'components/sharecart/'
        );
        $assetsUrl = $this->modx->getOption('sharecart_assets_url', $config,
            $this->modx->getOption('assets_url') . 'components/sharecart/'
        );
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $connectorUrl,

            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'templatesPath' => $corePath . 'elements/templates/',
            'chunkSuffix' => '.chunk.tpl',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'processorsPath' => $corePath . 'processors/',
        ), $config);

        $this->modx->addPackage('sharecart', $this->config['modelPath']);
        $this->modx->lexicon->load('sharecart:default');
    }



    public function addProduct($addProduct = array()){

        $key_user = $this->_checkIsUser();

        foreach ($addProduct['cart'] as $cart){
            $addCart[] = $cart;
        }

        $this->modx->newObject('shareCartItem', array(
            'cart' => array('name' => 1),
            'session_key' => 123
        ));
    }

    public function _checkIsUser(){

        if(!$_SESSION['key_user']){
            return $_SESSION['key_user'] = md5(time());
        }else{
            return $_SESSION['key_user'];
        }

    }

}