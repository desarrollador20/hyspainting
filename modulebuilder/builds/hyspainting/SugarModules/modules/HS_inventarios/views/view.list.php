<?php


class HS_inventariosViewList extends ViewList
{
    private $modo;

    const REASIGNAR = 'reasignar';
    const OTRO = 'otro';

    public function preDisplay()
    {
        //$this->bean->prestado = 'HS_inventarios';
        parent::preDisplay();
        
        $this->loadStyles([
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css',
            'modules/HS_inventarios/css/jquery.datetimepicker.css',
            'modules/HS_Programador/javascript/select2/select2.min.css'
            
        ]);
        
        $this->loadScripts([
            'modules/HS_inventarios/javascript/dialogo_sms.js',
            'modules/HS_inventarios/javascript/jquery.datetimepicker.js',
            'modules/HS_Programador/javascript/select2/select2.min.js'
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
