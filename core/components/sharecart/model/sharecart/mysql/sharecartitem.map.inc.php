<?php
$xpdo_meta_map['shareCartItem']= array (
  'package' => 'sharecart',
  'version' => '1.1',
  'table' => 'sharecart_items',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'session_key' => '',
    'cart' => '{}',
    'user_id' => '',
  ),
  'fieldMeta' => 
  array (
    'session_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'cart' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'json',
      'default' => '{}',
    ),
    'user_id' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
);
