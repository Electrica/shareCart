<?php

/**
 *
 */
class shareCart
{
    /** @var modX $modx */
    public $modx;
    public $class_name = 'shareCartItem';


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

        $saveItem = array();
        $saveItem['session_key'] = $this->_checkIsUser();

        foreach ($addProduct['cart'] as $cart){
            $saveItem['cart'][] = $cart;
        }
        $this->_saveTable($saveItem);
    }

    public function updateProduct($updateProduct = array()){

        $saveItem = array();
        $saveItem['session_key'] = $this->_checkIsUser();

        foreach ($updateProduct['cart'] as $cart) {
            $saveItem['cart'][] = $cart;
        }
        $this->_saveTable($saveItem);

    }

    public function getCart($cart = ''){
        $output = array();
        if($cart){
            $getCart = $this->modx->getObject('shareCartItem', array('session_key' => $cart));
            $cart = $getCart->get('cart');
            foreach($cart as $c){
                $output[] = $c['id'];
            }
        }
        return $output;
    }

    protected function _saveTable($saveItem = array()){
        if(!$this->modx->getCount($this->class_name, array('session_key' => $saveItem['session_key']))){
            $item = $this->modx->newObject($this->class_name, $saveItem);
            $item->save();
        }else{
            $item = $this->modx->getObject($this->class_name, array('session_key' => $saveItem['session_key']));
            $item->set('cart', $saveItem['cart']);
            $item->save();
        }
    }

     protected function _checkIsUser(){

        if(!$_SESSION['keyUser']){
            return $_SESSION['keyUser'] = md5(time());
        }else{
            return $_SESSION['keyUser'];
        }

    }

}