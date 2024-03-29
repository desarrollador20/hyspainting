<?php
$viewdefs ['Project'] = 
array (
  'DetailView' => 
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Project/Project.js',
        ),
        1 => 
        array (
          'file' => 'modules/Project/js/custom_project.js',
        ),
      ),
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button" type="submit" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}"onclick="{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'ProjectTemplatesEditView\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\'; {/if}"/>',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => ' {$APP.LBL_EDIT_BUTTON_LABEL} ',
              'htmlOptions' => 
              array (
                'id' => 'edit_button',
                'class' => 'button',
                'accessKey' => '{$APP.LBL_EDIT_BUTTON_KEY}',
                'name' => 'Edit',
                'onclick' => '{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'ProjectTemplatesEditView\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\'; {/if}',
              ),
            ),
          ),
          1 => 
          array (
            'customCode' => '<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" type="button" name="Delete" id="delete_button" value="{$APP.LBL_DELETE_BUTTON_LABEL}" onclick="project_delete(this);"/>',
            'sugar_html' => 
            array (
              'type' => 'button',
              'id' => 'delete_button',
              'value' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_DELETE_BUTTON_TITLE}',
                'accessKey' => '{$APP.LBL_DELETE_BUTTON_KEY}',
                'id' => 'delete_button',
                'class' => 'button',
                'onclick' => 'project_delete(this);',
              ),
            ),
          ),
          2 => 
          array (
            'customCode' => '<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" type="submit" name="Duplicate" id="duplicate_button" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}"onclick="{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'projecttemplateseditview\'; this.form.return_id.value=\'{$id}\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\'; this.form.return_id.value=\'{$id}\';{/if}""/>',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_DUPLICATE_BUTTON_LABEL}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_DUPLICATE_BUTTON_TITLE}',
                'accessKey' => '{$APP.LBL_DUPLICATE_BUTTON_KEY}',
                'class' => 'button',
                'name' => 'Duplicate',
                'id' => 'duplicate_button',
                'onclick' => '{if $IS_TEMPLATE}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'ProjectTemplatesDetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'projecttemplateseditview\'; this.form.return_id.value=\'{$id}\';{else}this.form.return_module.value=\'Project\'; this.form.return_action.value=\'DetailView\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\'; this.form.return_id.value=\'{$id}\';{/if}',
              ),
            ),
          ),
          3 => 
          array (
            'customCode' => '<input title="{$APP.LBL_VIEW_GANTT_TITLE}" class="button" type="button" name="view_gantt" id="view_gantt" value="{$APP.LBL_GANTT_BUTTON_LABEL}" onclick="javascript:window.location.href=\'index.php?module=Project&action=view_GanttChart&record={$id}\'"/>',
          ),
          4 => 
          array (
            'customCode' => '<input title="{$APP.LBL_VIEW_DETAIL}" class="button" type="button" name="view_detail" id="view_detail" value="{$APP.LBL_DETAIL_BUTTON_LABEL}" onclick="javascript:window.location.href=\'index.php?module=Project&action=DetailView&record={$id}\'"/>',
          ),
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_PROJECT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_project_information' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'jjwg_maps_address_c',
            'label' => 'LBL_JJWG_MAPS_ADDRESS',
          ),
        ),
        1 => 
        array (
          0 => 'status',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'estimated_start_date',
            'label' => 'LBL_DATE_START',
          ),
          1 => 
          array (
            'name' => 'compania_c',
            'studio' => 'visible',
            'label' => 'LBL_COMPANIA',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Project description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'hora_entrada_c',
            'label' => 'LBL_HORA_ENTRADA',
          ),
          1 => 
          array (
            'name' => 'pagos_extra_c',
            'studio' => 'visible',
            'label' => 'LBL_PAGOS_EXTRA',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'tipo_cobro_c',
            'studio' => 'visible',
            'label' => 'LBL_TIPO_COBRO',
          ),
          1 => 
          array (
            'name' => 'mostrar_dirrecion_en_factura_c',
            'label' => 'LBL_MOSTRAR_DIRRECION_EN_FACTURA',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'valor_contrato_c',
            'label' => 'LBL_VALOR_CONTRATO',
          ),
          1 => 
          array (
            'name' => 'valor_pagado_c',
            'label' => 'LBL_VALOR_PAGADO',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'valores_pagar_c',
            'studio' => 'visible',
            'label' => 'LBL_VALORES_PAGAR',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'estimated_end_date',
            'label' => 'LBL_DATE_END',
          ),
          1 => '',
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 
          array (
            'name' => 'am_projecttemplates_project_1_name',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'dias_gracia_c',
            'label' => 'LBL_DIAS_GRACIA',
          ),
          1 => 
          array (
            'name' => 'dias_corte_c',
            'studio' => 'visible',
            'label' => 'LBL_DIAS_CORTE',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'max_pago_horas_viaje_proyect_c',
            'label' => 'LBL_MAX_PAGO_HORAS_VIAJE_PROYECT',
          ),
          1 => 
          array (
            'name' => 'max_pago_horas_viaje_usuario_c',
            'label' => 'LBL_MAX_PAGO_HORAS_VIAJE_USUARIO',
          ),
        ),
      ),
    ),
  ),
);
;
?>
