<?php
$module_name = 'HS_Registro_horas';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'proyecto' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROYECTO',
        'id' => 'PROJECT_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'proyecto',
      ),
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
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
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
      'proyecto' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROYECTO',
        'id' => 'PROJECT_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'proyecto',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
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
