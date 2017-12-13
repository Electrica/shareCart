<?php

if(empty($_REQUEST['action'])){
    die("Access denied");
}else{
    $action = $_REQUEST['action'];
}


require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH.'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('web');
$modx->getService('error','error.modError', '', '');


$shareCart = $modx->getService('shareCart','shareCart',$modx->getOption('sharecart_core_path',null,$modx->getOption('core_path').'components/sharecart/').'model/sharecart/');
$miniShop2 = $modx->getService('miniShop2');


/**
 * @var shareCart $shareCart
 */

switch ($action){
    case 'createCart':
        if($shareCart && $miniShop2){
            // Инициализируем класс в текущий контекст

            /**
             * @var miniShop2 $miniShop2
             */
            $miniShop2->initialize($modx->context->key);
            $cart = $miniShop2->cart->get();
            $output = $shareCart->addProduct($cart);
            $link = $modx->makeUrl($modx->getOption('sharecart_pagecart_id'), $modx->context->key,'','full') . "&cart=" . $output;
            echo $link;
        }
        break;

    case 'deleteCart':
        if($id = $_POST['id']){
            if($shareCart && $miniShop2){
                $response = $shareCart->deleteProduct($id);
            }
            echo $response;
        }
        break;
}