<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var shareCart $shareCart */
if (!$shareCart = $modx->getService('sharecart', 'shareCart', $modx->getOption('sharecart_core_path', null,
        $modx->getOption('core_path') . 'components/sharecart/') . 'model/sharecart/', $scriptProperties)
) {
    return 'Could not load shareCart class!';
}
/**
 * @var pdoFetch $pdoFetch
 */
$pdoFetch = $modx->getService('pdoFetch');
$tpl = $modx->getOption('tpl', $scriptProperties, 'getShareCart');
$output = '';

$carts = $shareCart->getCart();
$outCarts = array();

foreach ($carts as $cart){
    $outCarts[] = $cart;
}

$output = $pdoFetch->getChunk($tpl, array('carts' => $outCarts));
return $output;