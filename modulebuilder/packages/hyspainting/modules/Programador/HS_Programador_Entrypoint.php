<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'modules/HS_Programador/controller.php';
require_once 'include/entryPoint.php';

$res = (object) ['results' => []];

$default = [
    'options' => [
        'default' => null
    ]
];

$action = $_REQUEST['action'] ?? null;


$controller = new HS_ProgramadorController();


switch ($action) {
    case 'getUserProyect':
        $id_proyecto = $_REQUEST['id_proyecto'];
        $res = $controller->getUser($id_proyecto);
        break;
    case 'getDuplicate':
        $fecha = $_REQUEST['fecha'];
        $res = $controller->verificarFechaProgramacion($fecha);
        break;
    case 'ObtenerUsuarios';
        $usuarios = [];
        if (isset($_REQUEST['usuarios'])) {
            $usuarios = $_REQUEST['usuarios'];
        }
        $res = $controller->obtenerUsuarios($usuarios);
        break;
    case 'obtenerProyecto' :
        $id_proyecto=$_REQUEST['proyecto'];
        $res=$controller->obtenerProyecto($id_proyecto);
        break;   
    case 'addExcel' :
        $id_proyecto=$_REQUEST['proyecto']; 
        
       $res=$controller->addExcel($id_proyecto);
       $res=$id_proyecto;
        break;
}

echo json_encode($res);
