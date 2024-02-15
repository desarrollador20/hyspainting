<?php

require_once 'modules/Configurator/Configurator.php';

use Api\V8\BeanDecorator\BeanManager;

class HS_ProgramadorViewEdit extends ViewEdit
{
    private static $scriptLoaded = false;
    public function __construct()
    {

        parent::__construct();
    }

    public function display()
    {

     

    

      

        if (!self::$scriptLoaded) {
          
            self::$scriptLoaded = true; // Marcar el script como cargado
        }

        parent::display();
     
    }







    
}



