<?php
$listViewDefs ['Project'] = 
array (
  'NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
  ),
  'COMPANIA_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_COMPANIA',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'ESTIMATED_START_DATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_START',
    'link' => false,
    'default' => true,
  ),
  'ESTIMATED_END_DATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_END',
    'link' => false,
    'default' => true,
  ),
  'PAGOS_EXTRA_C' => 
  array (
    'type' => 'multienum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PAGOS_EXTRA',
    'width' => '10%',
  ),
  'DIAS_CORTE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DIAS_CORTE',
    'width' => '10%',
  ),
  'TIPO_COBRO_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TIPO_COBRO',
    'width' => '10%',
  ),
  'DIAS_GRACIA_C' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_DIAS_GRACIA',
    'width' => '10%',
  ),
  'HORA_ENTRADA_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => false,
    'label' => 'LBL_HORA_ENTRADA',
    'width' => '10%',
  ),
  'VALOR_PAGADO_C' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_VALOR_PAGADO',
    'currency_format' => true,
    'width' => '10%',
  ),
  'VALORES_PAGAR_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_VALORES_PAGAR',
    'sortable' => false,
    'width' => '10%',
  ),
  'VALOR_CONTRATO_C' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_VALOR_CONTRATO',
    'currency_format' => true,
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER_ID',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
);
;
?>
