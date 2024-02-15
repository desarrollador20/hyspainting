<?php
$module_name = 'HS_Facturador';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'TRABAJADOR' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_TRABAJADOR',
    'id' => 'USER_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'VALOR_PAGAR' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_VALOR_PAGAR',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'DESCUENTOS' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_DESCUENTOS',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'TOTAL' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_TOTAL',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'PAGADO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PAGADO',
    'width' => '10%',
    'default' => true,
  ),
  'ESTADO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ESTADO',
    'width' => '10%',
    'default' => false,
  ),
  'PROYECTO' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_PROYECTO',
    'id' => 'PROJECT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => false,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
);
;
?>
