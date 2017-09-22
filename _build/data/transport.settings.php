<?php
/** @var modX $modx */
/** @var array $sources */

$settings = array();

$tmp = array(
    'pagecart_id' => array(
        'xtype' => 'textarea',
        'value' => '',
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
