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
            'modules/HS_Registro_horas/javascript/actualizar_masivo.js',
        ]);

        echo "<script>setTimeout(function() {
            var div = document.getElementById('MassAssign_SecurityGroups');
            if (div) {
                div.style.display = 'none';
            }
        }, 100);
        </script>";
        
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
