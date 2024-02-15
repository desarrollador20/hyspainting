<?php
$module_name = 'HS_inventarios';
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
        'file'=> 'modules/HS_inventarios/javascript/view.edit.js'
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
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'num_serie',
            'label' => 'LBL_NUM_SERIE',
          ),
          1 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'marca',
            'label' => 'LBL_MARCA',
          ),
          1 => 
          array (
            'name' => 'modelo',
            'label' => 'LBL_MODELO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'ubicacion',
            'studio' => 'visible',
            'label' => 'LBL_UBICACION',
          ),
          1 => 
          array (
            'name' => 'estado',
            'studio' => 'visible',
            'label' => 'LBL_ESTADO',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
;
?>
