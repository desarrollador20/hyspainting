<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'modules/HS_inventarios/controller.php';
require_once 'include/entryPoint.php';

$res = (object) ['results' => []];

$default = [
    'options' => [
        'default' => null
    ]
];

$action = $_REQUEST['action'] ?? null;

$controller = new HS_inventariosController();

switch ($action) {
    case 'getUsuarios':
        $res = $controller->getUser();
        break;
    case 'getListas':
        $res = $controller->getListas();
        break;
    case 'savePrestamo':
        $data=['id'=>$_REQUEST['id'], 'estado'=>$_REQUEST['estado'], 'usuario'=>$_REQUEST['usuario'], 'fecha'=>$_REQUEST['fecha'], 'prestado'=>$_REQUEST['prestado'], 'devuelto'=>$_REQUEST['devuelto']];
        $res=$controller->savePrestamo($data);
        break;

    case 'getSerial':
        $serial=$_REQUEST['serial'];
        $res=$controller->getSerial($serial);
        break;    
}

echo json_encode($res);
