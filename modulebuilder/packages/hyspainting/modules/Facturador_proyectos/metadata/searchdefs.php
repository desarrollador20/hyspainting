<?php
$module_name = 'HS_Facturador_proyectos';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'proyecto' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROYECTO',
        'id' => 'PROJECT_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'proyecto',
      ),
      'num_factura' => 
      array (
        'type' => 'int',
        'label' => 'LBL_NUM_FACTURA',
        'width' => '10%',
        'default' => true,
        'name' => 'num_factura',
      ),
      'customer_id' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_CUSTOMER_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'customer_id',
      ),
      'salesperson' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_SALESPERSON',
        'width' => '10%',
        'default' => true,
        'name' => 'salesperson',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      0 => 'name',
      1 => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
;
?>
