<?php
$module_name = 'HS_Registro_horas';
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
          0 => 'name',
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'proyecto',
            'studio' => 'visible',
            'label' => 'LBL_PROYECTO',
          ),
          1 => 
          array (
            'name' => 'trabajador',
            'studio' => 'visible',
            'label' => 'LBL_TRABAJADOR',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'fecha',
            'label' => 'LBL_FECHA',
          ),
          1 => 
          array (
            'name' => 'dia',
            'studio' => 'visible',
            'label' => 'LBL_DIA',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'horas_trabajo',
            'label' => 'LBL_HORAS_TRABAJO',
          ),
          1 => 
          array (
            'name' => 'horas_viaje',
            'label' => 'LBL_HORAS_VIAJE ',
          ),
        ),
        4 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
;
?>
