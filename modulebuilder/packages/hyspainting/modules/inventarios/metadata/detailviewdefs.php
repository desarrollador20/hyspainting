<?php
$module_name = 'HS_inventarios';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
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
            'name' => 'num_serie',
            'label' => 'LBL_NUM_SERIE',
          ),
          1 => 
          array (
            'name' => 'marca',
            'label' => 'LBL_MARCA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'modelo',
            'label' => 'LBL_MODELO',
          ),
          1 => 
          array (
            'name' => 'ubicacion',
            'studio' => 'visible',
            'label' => 'LBL_UBICACION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'estado',
            'studio' => 'visible',
            'label' => 'LBL_ESTADO',
          ),
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'cantidades_inventario',
            'label' => 'LBL_CANTIDADES_INVENTARIO',
          ),
          1 => 
          array (
            'name' => 'cantidades_prestadas',
            'label' => 'LBL_CANTIDADES_PRESTADAS',
          ),
        ),
      ),
    ),
  ),
);
;
?>
