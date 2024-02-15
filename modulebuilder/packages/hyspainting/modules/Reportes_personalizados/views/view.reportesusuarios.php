<?php

require_once('include/MVC/View/views/view.edit.php');
require_once('include/MVC/View/views/view.detail.php');
require_once('include/EditView/EditView2.php');


class CustomHS_Reportes_personalizadosViewReportesusuarios extends SugarView
{
    function display()
    {


       // $data_select = $this->select_ultimos_8_bloques_14_dias();
        $trabajadores=$this->get_trabajadores();
        $tipoReporte='usuarios';
        global $sugar_config;
        // $this->ss->assign('CID' , $_REQUEST[ 'cid' ]);
        // $this->ss->assign( 'TIPOS_DOCUMENTO', $GLOBALS[ 'app_list_strings' ][ 'tipo_identificacion_afiliado_list' ] );
        $this->ss->assign('semanas', $data_select);
        $this->ss->assign('trabajadores', $trabajadores);
        $this->ss->assign('tipoReporte', $tipoReporte);
        $this->ss->display('modules/HS_Reportes_personalizados/tpls/setreportesusuarios.tpl');
    }


    private function select_ultimos_8_bloques_14_dias()
    {
        $options = array();
    
        // Nombres de meses en español
        $meses = array(
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        );
    
        // Establecer la zona horaria
        date_default_timezone_set('Europe/Berlin');
    
        // Obtener la fecha actual
        $currentDate = new DateTime();
    
        // Ajustar la fecha actual al último domingo
        $currentDate->modify('last Sunday');
    
        // Generar las opciones para los últimos 8 bloques de 14 días
        for ($i = 0; $i < 8; $i++) {
            $startDate = clone $currentDate;
            $endDate = clone $currentDate;
            $endDate->modify('-13 days'); // Retroceder exactamente 14 días para llegar al sábado
    
            $label = $startDate->format('d de F de Y') . " al " . $endDate->format('d de F de Y');
            $value = $startDate->format('Y-m-d') . "," . $endDate->format('Y-m-d');
    
            $options[] = array("label" => $label, "value" => $value);
    
            // Retroceder 14 días para la siguiente iteración
            $currentDate->modify('-14 days');
        }
    
        // Invertir el orden para que las fechas estén en orden cronológico
        $options = array_reverse($options);
    
        return $options;
    }
    
    

    private function get_trabajadores(){
      //  $trabajadores=[''=>''];
        $query="select id, first_name, last_name from users where deleted=0 and status='Active'";
        $rs=$GLOBALS['db']->query($query);
        while($row = $GLOBALS['db']->fetchByAssoc($rs)){
            $trabajadores[$row['id']]=$row['first_name'].' '.$row['last_name'];
        }
        return $trabajadores;

    }
}
