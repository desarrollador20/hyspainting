<?php 
 //WARNING: The contents of this file are auto-generated


$dictionary['Case']['fields']['causa_c'] = array (
      'inline_edit' => '',
      'labelValue' => 'causas',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'causa_c',
      'vname' => 'LBL_CAUSAS',
      'type' => 'varchar',
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
      'len' => '255',
      'size' => '20',
      'id' => 'Casescausa_c',
);

$dictionary['Case']['fields']['fecha_rechazo_aditoria_c'] = array (
    'inline_edit' => '1',
    'labelValue' => 'Fecha rechazo auditoría',
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'fecha_rechazo_aditoria_c',
    'vname' => 'LBL_FECHA_RECHAZO_ADITORIA_C',
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
    'id' => 'Casesfecha_rechazo_aditoria_c',
   // 'custom_module' => 'Cases',
);

$dictionary['Case']['fields']['rechazo_auditoria_c'] =  array (
    'inline_edit' => '1',
    'labelValue' => 'Rechazo auditoria',
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'rechazo_auditoria_c',
    'vname' => 'LBL_RECHAZO_AUDITORIA_C',
    'type' => 'bool',
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
 //   'len' => '255',
    'size' => '20',
    'id' => 'Casesrechazo_auditoria_c',
    //'custom_module' => 'Cases',
);

$dictionary['Case']['fields']['user_id1_c'] = array (
    'inline_edit' => 1,
    'required' => false,
    'source' => 'custom_fields',
    'name' => 'user_id1_c',
    'vname' => 'LBL_USUARIO_RECHAZO_AUDITORIA_C_USER_ID',
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
    'id' => 'Casesuser_id1_c',
  //  'custom_module' => 'Cases',
);
$dictionary['Case']['fields']['usuario_rechazo_auditoria_c'] = array (
  'inline_edit' => '1',
  'labelValue' => 'Usuario rechazo auditoría',
  'required' => false,
  'source' => 'non-db',
  'name' => 'usuario_rechazo_auditoria_c',
  'vname' => 'LBL_USUARIO_RECHAZO_AUDITORIA_C',
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
  'id_name' => 'user_id1_c',
  'ext2' => 'Users',
  'module' => 'Users',
  'rname' => 'name',
  'quicksearch' => 'enabled',
  'studio' => 'visible',
  'id' => 'Casesusuario_rechazo_auditoria_c',
 // 'custom_module' => 'Cases',
);




 // created: 2023-12-27 20:17:56
$dictionary['Case']['fields']['cohortes_c']['inline_edit']='1';
$dictionary['Case']['fields']['cohortes_c']['labelValue']='Cohortes';

 

 // created: 2023-08-08 17:29:08
$dictionary['Case']['fields']['jjwg_maps_address_c']['inline_edit']=1;

 

 // created: 2023-08-08 17:29:08
$dictionary['Case']['fields']['jjwg_maps_geocode_status_c']['inline_edit']=1;

 

 // created: 2023-08-08 17:29:08
$dictionary['Case']['fields']['jjwg_maps_lat_c']['inline_edit']=1;

 

 // created: 2023-08-08 17:29:08
$dictionary['Case']['fields']['jjwg_maps_lng_c']['inline_edit']=1;

 

 // created: 2023-08-22 23:09:37
$dictionary['Case']['fields']['valeri_c']['inline_edit']='1';
$dictionary['Case']['fields']['valeri_c']['labelValue']='valeri';

 
?>