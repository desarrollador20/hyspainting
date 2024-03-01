<?php

require_once('modules/HS_Facturador_proyectos/HS_Facturador_proyectosListViewSmarty.php');

class HS_Facturador_proyectosViewList extends ViewList
{
    /**
     * @see ViewList::preDisplay()
     */
    public function preDisplay()
    {
        require_once('modules/HS_Facturador_proyectos/formLetter.php');
        formLetter::LVPopupHtml('HS_Facturador_proyectos');
       

        parent::preDisplay();
        echo "<script>setTimeout(function() {
            var div = document.getElementById('MassAssign_SecurityGroups');
            if (div) {
                div.style.display = 'none';
            }
        }, 100);
        </script>";
        $this->lv = new HS_Facturador_proyectosListViewSmarty();
    }
}
