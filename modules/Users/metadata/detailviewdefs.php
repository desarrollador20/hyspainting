<?php
$viewdefs ['Users'] = 
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_USER_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EMPLOYEE_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'collapsed',
        ),
      ),
    ),
    'panels' => 
    array (
      'LBL_USER_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 'full_name',
          1 => 'user_name',
        ),
        1 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'fecha_ingreso_c',
            'label' => 'LBL_FECHA_INGRESO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'puesto_c',
            'studio' => 'visible',
            'label' => 'LBL_PUESTO',
          ),
          1 => 
          array (
            'name' => 'valor_hora_c',
            'label' => 'LBL_VALOR_HORA',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'apto_c',
            'label' => 'LBL_APTO',
          ),
          1 => 'phone_mobile',
        ),
        4 => 
        array (
          0 => 'photo',
        ),
      ),
      'LBL_EMPLOYEE_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 'employee_status',
          1 => 'show_on_employees',
        ),
        1 => 
        array (
          0 => 'phone_work',
        ),
        2 => 
        array (
          0 => '',
          1 => '',
        ),
        3 => 
        array (
          0 => 'reports_to_name',
          1 => 'phone_other',
        ),
        4 => 
        array (
          0 => '',
          1 => 'phone_home',
        ),
        5 => 
        array (
          0 => 'address_street',
          1 => 'address_city',
        ),
        6 => 
        array (
          0 => 'address_state',
        ),
        7 => 
        array (
          0 => 'address_country',
        ),
        8 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
;
?>
