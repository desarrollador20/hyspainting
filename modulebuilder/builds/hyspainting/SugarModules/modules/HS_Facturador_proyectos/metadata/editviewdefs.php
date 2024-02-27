<?php
$module_name = 'HS_Facturador_proyectos';
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
            'name' => 'fecha_pago',
            'label' => 'LBL_FECHA_PAGO',
          ),
          1 => 
          array (
            'name' => 'fecha_proximo_reporte',
            'label' => 'LBL_FECHA_PROXIMO_REPORTE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'job',
            'label' => 'LBL_JOB',
          ),
          1 => 
          array (
            'name' => 'customer_id',
            'label' => 'LBL_CUSTOMER_ID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'salesperson',
            'label' => 'LBL_SALESPERSON',
          ),
          1 => '',
        ),
        3 => 
        array (
          0 => 'description',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'notas',
            'studio' => 'visible',
            'label' => 'LBL_NOTAS',
          ),
        ),
      ),
    ),
  ),
);
;
?>
