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

        if($this->modx->user->id){
            $saveItem['user_id'] = $this->modx->user->id;
        }else{
            if(!$_SESSION['userId']){
                $saveItem['user_id'] = md5(time() . rand(0,1000));
                $_SESSION['userId'] = $saveItem['user_id'];
            }else{
                $saveItem['user_id'] = $_SESSION['userId'];
            }

        }

        $n = array();
        $sessionKey = '';
        foreach ($addProduct as $key => $val){
            $sessionKey .= $key;
            $n[] = $val;
        }
        $saveItem['session_key'] = md5($sessionKey);
        $saveItem['cart'] = $n;
        return $this->_saveTable($saveItem);
    }

    public function deleteProduct($id = ''){
        if($id){
            /**
             * @var xPDOObject $remove
             */
            $remove = $this->modx->getObject('shareCartItem', array('id' => $id));
            if($remove->remove()){
                return "Удалено успешно";
            }else{
                return "Произошла ошибка";
            }

        }
    }

    public function getCart($cart = ''){
        $output = array();
        $userId = !empty($this->modx->user->id) ? $this->modx->user->id : $_SESSION['keyUser'];

        $carts = $this->modx->getCollection($this->class_name, array('user_id' => $userId));

        foreach ($carts as $key => $val){
            $output[] = array(
                'link' => $this->modx->makeUrl($this->modx->getOption('sharecart_pagecart_id'), $this->modx->context->key,'','full') . "&cart=" . $val->get('session_key'),
                'carts' => $val->toArray()
            );
        }
        return $output;
    }

    public function getCartPlugin($cart = ''){
        if($cart){
            $response = $this->modx->getObject('shareCartItem', array('session_key' => $cart));
            return $response->toArray();
        }
    }

    protected function _saveTable($saveItem = array()){

        if(!$this->modx->getCount($this->class_name, array('session_key' => $saveItem['session_key'], 'user_id' => $saveItem['user_id']))){
            $item = $this->modx->newObject($this->class_name, $saveItem);
            $item->save();
        }else{
            $item = $this->modx->getObject($this->class_name, array('session_key' => $saveItem['session_key'], 'user_id' => $saveItem['user_id']));
            $item->set('cart', $saveItem['cart']);
            $item->save();
        }

        //Возвращаем этот объект
        $q = $this->modx->newQuery($this->class_name);
        $q->where(array(
            'session_key' => $saveItem['session_key'],
            'user_id' => $saveItem['user_id']
        ));
        $output = $this->modx->getObject($this->class_name, $q);
        return $output->get('session_key');
    }

     protected function _checkIsUser(){

        if(!$_SESSION['keyUser']){
            return $_SESSION['keyUser'] = md5(time());
        }else{
            return $_SESSION['keyUser'];
        }

    }

}