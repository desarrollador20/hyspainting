<?php
$module_name = 'HS_Facturador';
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
            'name' => 'desde',
            'label' => 'LBL_DESDE',
          ),
          1 => 
          array (
            'name' => 'hasta',
            'label' => 'LBL_HASTA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'trabajador',
            'studio' => 'visible',
            'label' => 'LBL_TRABAJADOR',
          ),
          1 => 
          array (
            'name' => 'valor_pagar',
            'label' => 'LBL_VALOR_PAGAR',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'descuentos',
            'label' => 'LBL_DESCUENTOS',
          ),
          1 => 
          array (
            'name' => 'total',
            'label' => 'LBL_TOTAL',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'pagado',
            'label' => 'LBL_PAGADO',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
;
?>
