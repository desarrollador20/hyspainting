<?php

require_once('include/MVC/View/views/view.edit.php');
require_once('include/MVC/View/views/view.detail.php');
require_once('include/EditView/EditView2.php');


class CustomHS_Registro_horasViewSetregistrohoras extends SugarView
{
    function display()
    {
        $data_select = $this->select_semana();
        $projects=$this->get_proyectos();
        global $sugar_config;
        // $this->ss->assign('CID' , $_REQUEST[ 'cid' ]);
        // $this->ss->assign( 'TIPOS_DOCUMENTO', $GLOBALS[ 'app_list_strings' ][ 'tipo_identificacion_afiliado_list' ] );
        $this->ss->assign('semanas', $data_select);
        $this->ss->assign('projects', $projects);
        $this->ss->display('modules/HS_Registro_horas/tpls/setregistrohoras.tpl');
    }


    private function select_semana()
    {
        $options = array();
    
        // Nombres de meses en español
        $meses = array(
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        );
    
        // Generar las opciones para las últimas 4 semanas
        for ($i = 0; $i < 4; $i++) {
            $startDate = strtotime("-$i weeks", strtotime('last Sunday'));
            $endDate = strtotime("next Saturday", $startDate);
            $label = date('d', $startDate) . " de " . $meses[(int)date('n', $startDate)] . " de " . date('Y', $startDate) . " al " .
                date('d', $endDate) . " de " . $meses[(int)date('n', $endDate)] . " de " . date('Y', $endDate);
            $value = date('Y-m-d', $startDate) . "," . date('Y-m-d', $endDate);
    
            $options[] = array("label" => $label, "value" => $value);
        }
    
        return $options;
    }
    

    private function get_proyectos(){
        $projec=array();
        $query="select id, name from project where deleted=0 and status='activo'";
        $rs=$GLOBALS['db']->query($query);
        while($row = $GLOBALS['db']->fetchByAssoc($rs)){
            $projec[$row['id']]=$row['name'];
        }
        return $projec;

    }
}
