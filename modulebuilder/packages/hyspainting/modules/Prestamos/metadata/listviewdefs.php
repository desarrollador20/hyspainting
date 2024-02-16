<?php
$module_name = 'HS_Prestamos';
$listViewDefs [$module_name] = 
array (
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
  'FECHA' => 
  array (
    'type' => 'date',
    'label' => 'LBL_FECHA',
    'width' => '10%',
    'default' => true,
  ),
  'VALOR' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_VALOR',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'ESTADO' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ESTADO',
    'width' => '10%',
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => false,
    'link' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
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
