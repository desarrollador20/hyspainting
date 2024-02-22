<?php


class HS_FacturadorViewList extends ViewList
{
    private $modo;

    const REASIGNAR = 'reasignar';
    const OTRO = 'otro';

    public function display()
    {
  
        $this->lv->quickViewLinks = false;
        $this->lv->delete=false;
        $this->lv->export=false;
        $this->lv->mergeduplicates=false;
        $this->lv->delete=false;
        $this->lv->delete=false;
        $this->lv->showMassupdateFields=false;
        


        parent::display();


    }


    public function preDisplay()
    {
       // $this->bean->prestado = 'HS_inventarios';
       
        parent::preDisplay();
        
        $this->loadStyles([
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css',
          
        ]);
        
        $this->loadScripts([
            'modules/HS_Facturador/javascript/pay.js',
            'modules/HS_Reportes_personalizados/tpls/javascript/alert.min.js'
        ]);
    }

    private function loadStyles($styles)
    {
        foreach ($styles as $style) {
            echo '<link rel="stylesheet" href="' . $style . '">';
        }
    }

    private function loadScripts($scripts)
    {
        foreach ($scripts as $script) {
            echo '<script src="' . $script . '"></script>';
        }
    }
}
