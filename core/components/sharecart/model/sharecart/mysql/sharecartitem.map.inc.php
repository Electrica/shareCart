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
    'user_id' => 0,
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
      'dbtype' => 'int',
      'precision' => '12',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
);
