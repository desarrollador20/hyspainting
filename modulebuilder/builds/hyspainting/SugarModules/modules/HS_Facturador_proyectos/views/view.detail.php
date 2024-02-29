<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//require_once('include/MVC/View/views/view.detail.php');

require_once('modules/HS_Facturador_proyectos/formLetter.php');
formLetter::DVPopupHtml('HS_Facturador_proyectos');

class HS_Facturador_proyectosViewDetail extends ViewDetail
{

    public function preDisplay()
    {
        parent::preDisplay();
        $this->loadScripts([
            'modules/HS_Facturador_proyectos/javascript/view.detail.js'
        ]);
    }

    public function display()
    {
        $this->ss->assign("setmail", '<input type="button" class="button" onClick="enviarFactura(\'' . $this->bean->id . '\', \'' . $this->bean->num_factura . '\', \'' . $this->bean->empresa . '\', \'' . $this->bean->proyecto . '\');" value="Enviar factura">');
        parent::display();
    }
    private function loadScripts($scripts)
    {
        foreach ($scripts as $script) {
            echo '<script src="' . $script . '"></script>';
        }
    }
}