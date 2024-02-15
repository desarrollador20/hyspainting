<?php
$module_name = 'HS_Programador';
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
          'IMPRIMIR_BOLETAS' => array (
            'customCode' => '<input />',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => 'Generar Excel',
              'htmlOptions' => 
                array (
                  'class' => 'button',
                  'id' => 'genFile_button',
                  'title' => 'genFile',
                  'onclick' => 'window.open(\'index.php?entryPoint=GetMethodsProgramadorEntryPoint&action=addExcel&amp;proyecto=\' + \'{$bean->id}\');',
                  'name' => 'genFile',
                ),
              ),
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
            'name' => 'estado_envio',
            'studio' => 'visible',
            'label' => 'LBL_ESTADO_ENVIO',
          ),
        ),
      ),
    ),
  ),
);
;
?>
