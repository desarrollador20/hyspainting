<?php
$module_name = 'HS_Prestamos';
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'trabajador',
            'studio' => 'visible',
            'label' => 'LBL_TRABAJADOR',
          ),
          1 => 
          array (
            'name' => 'fecha',
            'label' => 'LBL_FECHA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'valor',
            'label' => 'LBL_VALOR',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
;
?>
