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

        $addProduct = array();
        $addProduct['cart'] = $cart->get();
        $shareCart->updateProduct($addProduct);

        break;

    case 'msOnRemoveFromCart':

        print_r($key);

        break;

    case 'msOnEmptyCart':

        break;

}