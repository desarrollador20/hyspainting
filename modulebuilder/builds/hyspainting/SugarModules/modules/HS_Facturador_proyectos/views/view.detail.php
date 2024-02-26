<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//require_once('include/MVC/View/views/view.detail.php');

require_once('modules/HS_Facturador_proyectos/formLetter.php');
formLetter::DVPopupHtml('HS_Facturador_proyectos');

class HS_Facturador_proyectosViewDetail extends ViewDetail
{

    public function preDisplay()
    {
        // $this->bean->prestado = 'HS_inventarios';
        parent::preDisplay();
        $this->loadScripts([
            'modules/HS_Facturador_proyectos/javascript/view.detail.js'
        ]);
    }

    public function display()
    {

        $datosFactura = $this->verificarFacturas();
        if ($datosFactura) {
            $this->ss->assign("setmail", '<input type="button" class="button" onClick="enviarFactura(\'' . $datosFactura . '\', \'' . $this->bean->num_factura . '\');" value="Enviar factura">');


        }
        parent::display();
    }
    private function loadScripts($scripts)
    {
        foreach ($scripts as $script) {
            echo '<script src="' . $script . '"></script>';
        }
    }

    private function verificarFacturas()
    {
        $query = "SELECT hs_facturador_proyectos_notesnotes_idb 
                  FROM hs_facturador_proyectos_notes_c
                  WHERE deleted = 0
                  ORDER BY date_modified DESC
                  LIMIT 1 ";
        $result = $GLOBALS['db']->query($query);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['hs_facturador_proyectos_notesnotes_idb'] ?? false;
        }
        return false;
    }
}