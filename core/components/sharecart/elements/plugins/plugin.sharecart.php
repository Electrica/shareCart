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

    case 'msOnAddToCart':

        $addProduct = array();
        $addProduct['cart'] = $cart->get();
        $shareCart->addProduct($addProduct);

        break;

    case 'msOnChangeInCart':
    case 'msOnRemoveFromCart':
        $updateProduct = array();
        $updateProduct['cart'] = $cart->get();
        $shareCart->updateProduct($updateProduct);

        break;


    case 'OnLoadWebDocument':

        $modx->regClientScript($shareCart->config['jsUrl'] . 'web/custom.sharecart.js');

        //Проверить наличие GET корзины

        if(isset($_GET['cart'])){
            $cart = $_GET['cart'];
            if($cart != $_SESSION['keyUser']){
                if ($miniShop2 = $modx->getService('miniShop2')) {
                    // Инициализируем класс в текущий контекст
                    $miniShop2->initialize($modx->context->key);

                    $output = $shareCart->getCart($cart);
                    foreach ($output as $id){
                        $miniShop2->cart->add($id);
                    }
                }
            }
        }

        break;

}