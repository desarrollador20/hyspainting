<?php


class HS_Registro_horasViewList extends ViewList
{
    private $modo;

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
        

        $this->loadScripts([
            'modules/Registro_horas/javascript/actualizar_masivo.js',
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
