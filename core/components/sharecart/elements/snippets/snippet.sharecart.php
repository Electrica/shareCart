<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var shareCart $shareCart */
if (!$shareCart = $modx->getService('sharecart', 'shareCart', $modx->getOption('sharecart_core_path', null,
        $modx->getOption('core_path') . 'components/sharecart/') . 'model/sharecart/', $scriptProperties)
) {
    return 'Could not load shareCart class!';
}

// Do your snippet code here. This demo grabs 5 items from our custom table.
$tpl = $modx->getOption('tpl', $scriptProperties, 'Item');
$output = '';

// Работаем только при наличии сессии с добавленным товаром
$keyUser = $_SESSION['keyUser'];
if($keyUser){
    $cart = $modx->getObject('shareCartItem', array('session_key' => $keyUser));
    if($cart){
        if($cart->get('cart') != null){
            $hash = $cart->get('session_key');
            $link = array(
                'link' => $modx->makeUrl($modx->resourceIdentifier, $modx->context->key,'','full') . '?cart=' . $hash
            );
            $output = $modx->getChunk($tpl, $link);
        }
    }
}
return $output;