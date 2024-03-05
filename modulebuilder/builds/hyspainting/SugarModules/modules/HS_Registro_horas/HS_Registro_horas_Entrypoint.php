<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'modules/HS_Registro_horas/controller.php';
require_once 'include/entryPoint.php';

$res = (object) ['results' => []];

$default = [
    'options' => [
        'default' => null
    ]
];

$action = $_REQUEST['action'] ?? null;


$controller = new HS_Registro_horasController();


switch($action){
    case 'getRegistros':
        $fechas=$_REQUEST['fechas'];
        $res=$controller->getRegistros($fechas);
       
      break;
    case 'validarRegistros':
        $idRegistros=$_REQUEST['idsRegistros'];
        $res=$controller->validarRegistros($idRegistros);
        if($res[0] != "0.0" || $res[1] != "0.0"){
            $res = "tiene";
        }else{
            $res = "OK";
        }
       
      break;
      case 'actualizarMasivo':
        $idRegistros=$_REQUEST['idsRegistros'];
        $horasTrabajo=$_REQUEST['horasTrabajo'];
        $horasViaje=$_REQUEST['horasViaje'];
        $res=$controller->actualizarMasivo($horasTrabajo,$horasViaje,$idRegistros);
       
       
      break;
     
}

echo json_encode($res);
