<?php


class HS_ProgramadorViewList extends ViewList
{
    private static $scriptLoaded = false;
    public function __construct()
    {

        parent::__construct();
    }


    
    public function display()
    {
  
        $this->lv->quickViewLinks = false;
        $this->lv->delete=false;

        parent::display();


    }

    





    private function loadScripts($scripts)
    {
        foreach ($scripts as $script) {
            echo '<script src="' . $script . '"></script>';
        }
    }






   


}
