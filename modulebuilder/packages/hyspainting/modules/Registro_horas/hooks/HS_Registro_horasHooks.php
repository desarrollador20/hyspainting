<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class HS_Registro_horasHooks
{

  
    public function agregarAccionActualizarMasivo($event, $arguments){

        if ($GLOBALS['app']->controller->module != 'HS_Registro_horas') return;
     
    
        switch ($GLOBALS['app']->controller->action) {
        
          case 'listview':
            $button_code = <<<EOQ
     
       <script type="text/javascript">
           $(document).ready(function(){
           var button1 = $('<li><a href="javascript:void(0)" );" onclick="sugarListView.get_checks(),actualizarMasivo(\document.MassUpdate.uid.value\,\document.MassUpdate.select_entire_list.value\,\document.MassUpdate.current_query_by_page.value\);">Agregar Horas Masivas</a></li>'); 
          // Add item to "bulk actions" dropdown button on list view
          var button2 = $('<li><a href="javascript:void(0)" );" onclick="sugarListView.get_checks(),actualizarMasivo(\document.MassUpdate.uid.value\,\document.MassUpdate.select_entire_list.value\,\document.MassUpdate.current_query_by_page.value\);">Agregar Horas Masivas</a></li>'); 
           $("#actionLinkTop").sugarActionMenu('addItem',{item:button1});
           $("#actionLinkBottom").sugarActionMenu('addItem',{item:button2});
           });
           </script>
    EOQ;
            echo $button_code;
            break;
        }
      }


    


}
