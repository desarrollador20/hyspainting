<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'modules/HS_Facturador/controller.php';
require_once 'include/entryPoint.php';

$res = (object) ['results' => []];

$default = [
    'options' => [
        'default' => null
    ]
];

$action = $_REQUEST['action'] ?? null;


$controller = new HS_FacturadorController();


switch ($action) {
    case 'addPago':
        $idFactura = $_REQUEST['idFactura'];
        $res = $controller->addPago($idFactura);
        break;
}

echo json_encode($res);
