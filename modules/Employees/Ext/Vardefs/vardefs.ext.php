<?php 
 //WARNING: The contents of this file are auto-generated



$dictionary['User']['fields']['apto_c'] = array(
    'inline_edit' => '',
    'labelValue' => 'Apto',
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'apto_c',
    'vname' => 'LBL_APTO',
    'type' => 'bool',
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
    'len' => '255',
    'size' => '20',
    'id' => 'Usersapto_c',

);




$dictionary['User']['fields']['fecha_ingreso_c'] = array(
    'inline_edit' => '',
    'labelValue' => 'Fecha de ingreso',
    'required' => true,
    'source' => 'custom_fields',
    'name' => 'fecha_ingreso_c',
    'vname' => 'LBL_FECHA_INGRESO',
    'type' => 'date',
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
    'display_default' => 'now',
    'id' => 'Usersfecha_ingreso_c',
);



$dictionary['User']['fields']['puesto_c'] = array (
    'inline_edit' => '',
    'labelValue' => 'Puesto',
    'required' => true,
    'source' => 'custom_fields',
    'name' => 'puesto_c',
    'vname' => 'LBL_PUESTO',
    'type' => 'enum',
    'massupdate' => '0',
    'default' => '',
    'no_default' => false,
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'hs_valores_pagar',
    'dependency' => false,
    'id' => 'Userspuesto_c',
);


$dictionary['User']['fields']['valor_hora_c'] = array(
    'inline_edit' => '',
    'labelValue' => 'Valor hora',
    'required' => true,
    'source' => 'custom_fields',
    'name' => 'valor_hora_c',
    'vname' => 'LBL_VALOR_HORA',
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
    'id' => 'Usersvalor_hora_c',
);

?>