<?php
$module_name = 'HS_Facturador_proyectos';
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
          4 => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup();" value="Generar factura">',
          ),
          5 => 
          array (
            'customCode' => '{$setmail}',
          ),
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
            'name' => 'num_factura',
            'label' => 'LBL_NUM_FACTURA',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'empresa',
            'studio' => 'visible',
            'label' => 'LBL_EMPRESA',
          ),
          1 => 
          array (
            'name' => 'proyecto',
            'studio' => 'visible',
            'label' => 'LBL_PROYECTO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'fecha_corte',
            'label' => 'LBL_FECHA_CORTE',
          ),
          1 => 
          array (
            'name' => 'n_horas',
            'label' => 'LBL_N_HORAS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'valor_total',
            'label' => 'LBL_VALOR_TOTAL',
          ),
          1 => 
          array (
            'name' => 'fecha_creacion',
            'label' => 'LBL_FECHA_CREACION',
          ),
        ),
        4 => 
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
        5 => 
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
        6 => 
        array (
          0 => 
          array (
            'name' => 'salesperson',
            'label' => 'LBL_SALESPERSON',
          ),
          1 => '',
        ),
        7 => 
        array (
          0 => 'description',
        ),
        8 => 
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
