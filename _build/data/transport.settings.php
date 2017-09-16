<?php
/** @var modX $modx */
/** @var array $sources */

$settings = array();

$tmp = array(
    'enable_share_cart' => array(
        'xtype' => 'combo-boolean',
        'value' => false,
        'area' => 'sharecart_main',
    ),
);

foreach ($tmp as $k => $v) {
    /** @var modSystemSetting $setting */
    $setting = $modx->newObject('modSystemSetting');
    $setting->fromArray(array_merge(
        array(
            'key' => 'sharecart_' . $k,
            'namespace' => PKG_NAME_LOWER,
        ), $v
    ), '', true, true);

    $settings[] = $setting;
}
unset($tmp);

return $settings;
