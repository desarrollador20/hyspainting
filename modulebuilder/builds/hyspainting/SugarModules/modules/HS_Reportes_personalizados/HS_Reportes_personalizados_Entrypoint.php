<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'modules/HS_Reportes_personalizados/controller.php';
require_once 'include/entryPoint.php';

$res = (object) ['results' => []];

$default = [
    'options' => [
        'default' => null
    ]
];

$action = $_REQUEST['action'] ?? null;


$controller = new HS_Reportes_personalizadosController();


switch ($action) {
    case 'getReporteUser':
        $id_trabajador = $_REQUEST['id_trabajador'];
        $desde = $_REQUEST['desde'];
        $hasta = $_REQUEST['hasta'];
        $res = $controller->getReporteUser($id_trabajador, $desde, $hasta);
        break;

    case 'getReporteProject':
        $res = $controller->getReporteProyecto($_REQUEST);
        break;
    case 'setFacturador':
        $res = $controller->setFacturadorUsuarios($_REQUEST);
        break;

    case 'verificarFacturaUsuarios':
        $res = $controller->verificarFacturaUsuarios($_REQUEST);
        break;

    case 'getInfoProyecto':
        $res = $controller->getInfoProyecto($_REQUEST['id_proyecto']);
        break;

    case 'setFacturadorProyectos':
        $res = $controller->setFacturadorProyectos($_REQUEST);
        break;
}

echo json_encode($res);
