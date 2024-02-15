<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class HS_FacturadorHooks
{

    public function addButtonPagar($bean, $event, $arguments)
    {
     
        // Verificar alguna condición en tu bean
        if ($bean->pagado=='No') {
            // Utilizar el icono con función onclick
            $icon = '<span class="icon-green"><i class="fas fa-check fa-2x" style="color: green;" onclick="pagar( \'' . $bean->id . '\')"title="Prestar"></i></span>';
            $icon = '<input type="button"  onclick="pagar( \'' . $bean->id . '\')" value="Pagar">';
        } else {
            // Utilizar el icono con función onclick
          $icon=  '<span class="icon-green"><i class="fas fa-check fa-2x" style="color: green;" "title="Prestar"></i></span>';
        }
        $bean->pagado = $icon;
    }


    public function addActionPagar($event, $arguments){

        if ($GLOBALS['app']->controller->module != 'HS_Facturador') return;
     
        // Based on what action we're in, add some buttons!
        $record_id = $GLOBALS['app']->controller->record;
    
    
        switch ($GLOBALS['app']->controller->action) {
        
          case 'listview':
            $button_code = <<<EOQ
     
       <script type="text/javascript">
           $(document).ready(function(){
           var button1 = $('<li><a href="javascript:void(0)" );" onclick="sugarListView.get_checks(),pagar(\document.MassUpdate.uid.value\,\document.MassUpdate.select_entire_list.value\,\document.MassUpdate.current_query_by_page.value\);">Pagar</a></li>'); 
          // Add item to "bulk actions" dropdown button on list view
          var button2 = $('<li><a href="javascript:void(0)" );" onclick="sugarListView.get_checks(),pagar(\document.MassUpdate.uid.value\);">Pagar</a></li>'); 
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
