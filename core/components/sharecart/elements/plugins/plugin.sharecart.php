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

    /**
     * Убирать ссылку на корзину, get параметр
     */

    case 'OnLoadWebDocument':

        $modx->regClientScript($shareCart->config['jsUrl'] . 'web/custom.sharecart.js');

        //Проверить наличие GET корзины

        if(isset($_GET['cart'])){
            $cart = $_GET['cart'];
            if($cart != $_SESSION['session_key']){
                if ($miniShop2 = $modx->getService('miniShop2')) {
                    $miniShop2->initialize($modx->context->key);

                    $output = $shareCart->getCartPlugin($cart);
                    if($output){
                        foreach ($output['cart'] as $val){
                            $miniShop2->cart->add($val['id'], $val['count'], $val['options']);
                        }
                        //Получаем ссылку без GET параметра
                        $url = str_replace('&cart='.$cart, '', $_SERVER['REQUEST_URI']);
                        $siteUrl = $_SERVER['HTTP_HOST'];
                        if(isset($_SERVER['HTTPS'])){
                            $siteUrl = 'https://'.$siteUrl;
                        }else{
                            $siteUrl = 'http://'.$siteUrl;
                        }
                        //Редиректим
                        $modx->sendRedirect($siteUrl.$url);

                    }else{
                        //TODO добавить 404
                    }

                }
            }
        }

        break;

}