<?php
$module_name = 'HS_Facturador_proyectos';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'PROYECTO' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_PROYECTO',
    'id' => 'PROJECT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'FECHA_CORTE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FECHA_CORTE',
    'width' => '10%',
    'default' => true,
  ),
  'N_HORAS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_N_HORAS',
    'width' => '10%',
    'default' => true,
  ),
  'VALOR_TOTAL' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_VALOR_TOTAL',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'FECHA_CREACION' => 
  array (
    'type' => 'date',
    'label' => 'LBL_FECHA_CREACION',
    'width' => '10%',
    'default' => true,
  ),
  'FECHA_PAGO' => 
  array (
    'type' => 'date',
    'label' => 'LBL_FECHA_PAGO',
    'width' => '10%',
    'default' => true,
  ),
  'FECHA_PROXIMO_REPORTE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FECHA_PROXIMO_REPORTE',
    'width' => '10%',
    'default' => true,
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
