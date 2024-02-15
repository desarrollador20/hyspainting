<?php 
 //WARNING: The contents of this file are auto-generated


$dictionary['Project']['fields']['account_id_c'] = array (
  'inline_edit' => 1,
  'required' => true,
  'source' => 'custom_fields',
  'name' => 'account_id_c',
  'vname' => 'LBL_COMPANIA_ACCOUNT_ID',
  'type' => 'id',
  'massupdate' => '0',
  'default' => NULL,
  'no_default' => false,
  'comments' => '',
  'help' => '',
  'importable' => 'true',
  'duplicate_merge' => 'disabled',
  'duplicate_merge_dom_value' => '0',
  'audited' => false,
  'reportable' => false,
  'unified_search' => false,
  'merge_filter' => 'disabled',
  'len' => '36',
  'size' => '20',
  'id' => 'Projectaccount_id_c',
);
$dictionary['Project']['fields']['compania_c'] = array (
  'inline_edit' => '',
  'labelValue' => 'Compania',
  'required' => true,
  'source' => 'non-db',
  'name' => 'compania_c',
  'vname' => 'LBL_COMPANIA',
  'type' => 'relate',
  'massupdate' => '0',
  'default' => NULL,
  'no_default' => false,
  'comments' => '',
  'help' => '',
  'importable' => 'true',
  'duplicate_merge' => 'disabled',
  'duplicate_merge_dom_value' => '0',
  'audited' => true,
  'reportable' => true,
  'unified_search' => false,
  'merge_filter' => 'disabled',
  'len' => '255',
  'size' => '20',
  'id_name' => 'account_id_c',
  'ext2' => 'Accounts',
  'module' => 'Accounts',
  'rname' => 'name',
  'quicksearch' => 'enabled',
  'studio' => 'visible',
  'id' => 'Projectcompania_c',
);




$dictionary['Project']['fields']['dias_corte_c'] = array (
    'inline_edit' => '',
    'labelValue' => 'Días de corte',
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'dias_corte_c',
    'vname' => 'LBL_DIAS_CORTE',
    'type' => 'enum',
    'massupdate' => '0',
    'default' => '',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'hs_dias_corte',
    'studio' => 'visible',
    'dependency' => false,
    'id' => 'Projectdias_corte_c',
);



$dictionary['Project']['fields']['dias_gracia_c'] = array(
    'inline_edit' => '1',
    'labelValue' => 'Días de gracia ',
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'dias_gracia_c',
    'vname' => 'LBL_DIAS_GRACIA',
    'type' => 'int',
    'massupdate' => '0',
    'default' => '0',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
    'enable_range_search' => false,
    'disable_num_format' => '',
    'min' => false,
    'max' => false,
    'id' => 'Projectdias_gracia_c',

);



$dictionary['Project']['fields']['hora_entrada_c'] = array (
    'inline_edit' => '',
    'labelValue' => 'Hora entrada',
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'hora_entrada_c',
    'vname' => 'LBL_HORA_ENTRADA',
    'type' => 'datetimecombo',
    'massupdate' => '0',
    'default' => '',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => false,
    'dbType' => 'datetime',
    'display_default' => 'now&12:00am',
    'id' => 'Projecthora_entrada_c',
);



$dictionary['Project']['fields']['pagos_extra_c'] = array (
    'inline_edit' => '',
    'labelValue' => 'Pagos extra',
    'required' => true,
    'source' => 'custom_fields',
    'name' => 'pagos_extra_c',
    'vname' => 'LBL_PAGOS_EXTRA',
    'type' => 'multienum',
    'massupdate' => '0',
    'default' => NULL,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'options' => 'hs_pagos_extra',
    'studio' => 'visible',
    'isMultiSelect' => true,
    'id' => 'Projectpagos_extra_c',
);

$dictionary['Project']['fields']['tipo_cobro_c'] = array (
    'inline_edit' => '',
    'labelValue' => 'Tipo cobro',
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'tipo_cobro_c',
    'vname' => 'LBL_TIPO_COBRO',
    'type' => 'enum',
    'massupdate' => '0',
    'default' => '',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'hs_tipo_cobro',
    'studio' => 'visible',
    'dependency' => false,
    'id' => 'Projecttipo_cobro_c',
);


$dictionary['Project']['fields']['valores_pagar_c'] = array(
      'inline_edit' => '',
      'labelValue' => 'Valores a pagar',
      'required' => true,
      'source' => 'custom_fields',
      'name' => 'valores_pagar_c',
      'vname' => 'LBL_VALORES_PAGAR',
      'type' => 'text',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'size' => '20',
      'studio' => 'visible',
      'function' => array(
        'name' => 'getValoresPagarWidget',
        'returns' => 'html'
        ),
      'rows' => '4',
      'cols' => '20',
      'id' => 'Projectvalores_pagar_c',
 
);





$dictionary['Project']['fields']['valor_contrato_c'] = array(
    'inline_edit' => '',
    'labelValue' => 'Valor contrato',
    'required' => true,
    'source' => 'custom_fields',
    'name' => 'valor_contrato_c',
    'vname' => 'LBL_VALOR_CONTRATO',
    'type' => 'currency',
    'massupdate' => '0',
    'default' => '',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '26',
    'size' => '20',
    'precision' => 6,
    'id' => 'Projectvalor_contrato_c',


);



$dictionary['Project']['fields']['valor_pagado_c'] = array(
    'inline_edit' => '',
    'labelValue' => 'Valor pagado',
    'required' => true,
    'source' => 'custom_fields',
    'name' => 'valor_pagado_c',
    'vname' => 'LBL_VALOR_PAGADO',
    'type' => 'currency',
    'massupdate' => '0',
    'default' => '',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '26',
    'size' => '20',
    'precision' => 6,
    'id' => 'Projectvalor_pagado_c',


);


 // created: 2023-08-14 17:38:54
$dictionary['Project']['fields']['description']['inline_edit']=true;
$dictionary['Project']['fields']['description']['comments']='Project description';
$dictionary['Project']['fields']['description']['merge_filter']='disabled';
$dictionary['Project']['fields']['description']['rows']='4';
$dictionary['Project']['fields']['description']['cols']='20';

 

 // created: 2023-08-08 17:29:09
$dictionary['Project']['fields']['jjwg_maps_address_c']['inline_edit']=1;

 

 // created: 2023-08-08 17:29:09
$dictionary['Project']['fields']['jjwg_maps_geocode_status_c']['inline_edit']=1;

 

 // created: 2023-08-08 17:29:09
$dictionary['Project']['fields']['jjwg_maps_lat_c']['inline_edit']=1;

 

 // created: 2023-08-08 17:29:09
$dictionary['Project']['fields']['jjwg_maps_lng_c']['inline_edit']=1;

 

 // created: 2023-09-19 16:25:53
$dictionary['Project']['fields']['status']['inline_edit']=true;
$dictionary['Project']['fields']['status']['options']='hs_estado_proyecto';
$dictionary['Project']['fields']['status']['merge_filter']='disabled';

 
?>