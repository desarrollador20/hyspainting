<?php
$module_name = 'HS_Prestamos';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'trabajador' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_TRABAJADOR',
        'id' => 'USER_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'trabajador',
      ),
      'fecha' => 
      array (
        'type' => 'date',
        'label' => 'LBL_FECHA',
        'width' => '10%',
        'default' => true,
        'name' => 'fecha',
      ),
      'estado' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ESTADO',
        'width' => '10%',
        'name' => 'estado',
      ),
      'valor' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_VALOR',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'valor',
      ),
    ),
    'advanced_search' => 
    array (
      'trabajador' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_TRABAJADOR',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'id' => 'USER_ID_C',
        'name' => 'trabajador',
      ),
      'estado' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ESTADO',
        'width' => '10%',
        'name' => 'estado',
      ),
      'valor' => 
      array (
        'type' => 'currency',
        'label' => 'LBL_VALOR',
        'currency_format' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'valor',
      ),
      'fecha' => 
      array (
        'type' => 'date',
        'label' => 'LBL_FECHA',
        'width' => '10%',
        'default' => true,
        'name' => 'fecha',
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
