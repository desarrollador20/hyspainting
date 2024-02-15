<?php

require_once 'modules/Configurator/Configurator.php';
require_once 'modules/HS_Programador/controller.php';

require 'modules/HS_Programador/excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class HS_ProgramadorViewDetail extends ViewDetail
{
    private static $scriptLoaded = false;
    public function __construct()
    {

        parent::__construct();
    }


    
    public function preDisplay()
    {
    
  

        parent::preDisplay();

        $this->loadScripts([
            'modules/HS_Programador/javascript/view.detail.js',
          
        ]);
    }

    public function display(){
        unset($this->dv->defs['templateMeta']['form']['buttons'][0]);
     parent::display();
    }





    private function loadScripts($scripts)
    {
        foreach ($scripts as $script) {
            echo '<script src="' . $script . '"></script>';
        }
    }






   


}
