<?php

require_once('include/MVC/View/views/view.edit.php');
require_once('include/MVC/View/views/view.detail.php');
require_once('include/EditView/EditView2.php');


class CustomHS_Reportes_personalizadosViewReportesproyectos extends SugarView
{
  
    function display()
    {


        $meses = $this->getMeses();
        $proyectos = $this->get_proyectos();

        $tipoReporte = 'proyectos';
        global $sugar_config;
        $currentYear = date("Y");
        $mesActual = date('n');
           // $this->ss->assign('CID' , $_REQUEST[ 'cid' ]);
        // $this->ss->assign( 'TIPOS_DOCUMENTO', $GLOBALS[ 'app_list_strings' ][ 'tipo_identificacion_afiliado_list' ] );
        $this->ss->assign('meses', $meses[0]);
        $this->ss->assign('proyectos', $proyectos);
        $this->ss->assign('tipoReporte', $tipoReporte);
        $this->ss->assign('anios', $meses[2]);
        $this->ss->assign('corte', $meses[1]);
        $this->ss->assign('year', $currentYear);
        $this->ss->assign('mes', $mesActual);



        $this->ss->display('modules/HS_Reportes_personalizados/tpls/setreportesproyectos.tpl');
    }


    private function getMeses()
    {
        $currentYear = date("Y");
        // Nombres de meses en español
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $corte = [
            1 => 'Uno',
            2 => 'Dos'
        ];

        $anios = [
            $currentYear - 1 => $currentYear - 1,
            $currentYear => $currentYear,
        ];
        return [$meses, $corte, $anios];
    }



    private function get_proyectos()
    {
        $proyectos = [];
        $query = "select id, name from project where deleted=0 and status='activo'";
        $rs = $GLOBALS['db']->query($query);
        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            $proyectos[$row['id']] = $row['name'];
        }
        return $proyectos;
    }
}
