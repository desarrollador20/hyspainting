<?php
$module_name = 'HS_Registro_horas';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'DIA' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_DIA',
    'width' => '10%',
    'default' => true,
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
  'HORAS_TRABAJO' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_HORAS_TRABAJO',
    'width' => '10%',
    'default' => true,
  ),
  'HORAS_VIAJE' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_HORAS_VIAJE ',
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
