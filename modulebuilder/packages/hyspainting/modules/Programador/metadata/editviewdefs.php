<?php
$module_name = 'HS_Programador';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),

      'includes'=>
      array(
        0=>
        array(
        'file'=> 'modules/HS_Programador/javascript/view.edit.js'
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fecha',
            'label' => 'LBL_FECHA',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'programacion',
            'studio' => 'visible',
            'label' => 'LBL_PROGRAMACION',
          ),
        ),
      ),
    ),
  ),
);
;
