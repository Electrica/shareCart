<?php
/** @var modX $modx
 * @var shareCart $shareCart
 */

if (!$shareCart = $modx->getService('sharecart', 'shareCart', $modx->getOption('sharecart_core_path', null,
        $modx->getOption('core_path') . 'components/sharecart/') . 'model/sharecart/', $scriptProperties)
) {
    return 'Could not load shareCart class!';
}

switch ($modx->event->name) {

    case 'OnLoadWebDocument':

        $modx->regClientScript($shareCart->config['jsUrl'] . 'web/custom.sharecart.js');

        //Проверить наличие GET корзины

        if(isset($_GET['cart'])){
            $cart = $_GET['cart'];
            if($cart != $_SESSION['keyUser']){
                if ($miniShop2 = $modx->getService('miniShop2')) {
                    $miniShop2->initialize($modx->context->key);

                    $output = $shareCart->getCartPlugin($cart);
                    if($output){
                        foreach ($output as $key){
                            foreach ($key as $val){
                                $miniShop2->cart->add($val['id'], $val['count'], $val['options']);
                            }
                        }
                    }else{
                        //TODO добавить 404
                    }

                }
            }
        }

        break;

}