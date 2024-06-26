<?php
$module_name = 'HS_inventarios';
$listViewDefs [$module_name] = 
array (
  'NUM_SERIE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_NUM_SERIE',
    'width' => '5%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '22%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'MARCA' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MARCA',
    'width' => '5%',
    'default' => true,
  ),
  'MODELO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MODELO',
    'width' => '10%',
    'default' => true,
  ),
  'CANTIDADES_INVENTARIO' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_CANTIDADES_INVENTARIO',
    'width' => '10%',
  ),
  'PRESTADO_A' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_PRESTADO_A',
    'id' => 'USER_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'FECHA_PRESTAMO' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_FECHA_PRESTAMO',
    'width' => '8%',
    'default' => true,
  ),
  'CANTIDADES_PRESTADAS' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_CANTIDADES_PRESTADAS',
    'width' => '10%',
  ),
  'PRESTADO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PRESTADO ',
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
