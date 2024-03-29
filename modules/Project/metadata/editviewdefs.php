<?php
$viewdefs ['Project'] = 
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Project/javascript/view.edit.js',
        ),
      ),
      'form' => 
      array (
        'hidden' => '<input type="hidden" name="is_template" value="{$is_template}" />',
        'headerTpl' => 'modules/Project/tpls/header.tpl',
        'footerTpl' => 'modules/Project/tpls/footer.tpl',
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" id ="SAVE_HEADER" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="SUGAR.projects.fill_invitees();document.EditView.action.value=\'Save\'; document.EditView.return_action.value=\'view_GanttChart\'; {if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}document.EditView.return_id.value=\'\'; {/if} formSubmitCheck();"type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
          1 => 
          array (
            'customCode' => '{if !empty($smarty.request.return_action) && $smarty.request.return_action == "ProjectTemplatesDetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesDetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif !empty($smarty.request.return_action) && $smarty.request.return_action == "DetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'DetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif $is_template}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesListView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'index\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {/if}',
          ),
        ),
      ),
      'javascript' => '<script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>
		{sugar_getscript file="cache/include/javascript/sugar_grp_project.js"}
		<script>toggle_portal_flag();function toggle_portal_flag()  {ldelim} {$TOGGLE_JS} {rdelim} 
		function formSubmitCheck(){ldelim}if(check_form(\'EditView\')){ldelim}document.EditView.submit();{rdelim}{rdelim}</script>',
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
          0 => 'estimated_start_date',
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
          0 => 'estimated_end_date',
          1 => '',
        ),
        9 => 
        array (
          0 => 'assigned_user_name',
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
