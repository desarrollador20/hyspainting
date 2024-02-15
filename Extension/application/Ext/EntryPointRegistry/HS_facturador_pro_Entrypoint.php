<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$entry_point_registry['formLetterProyectos'] = array(
    'file' => 'modules/HS_Facturador_proyectos/formLetterPdf.php',
    'auth' => true,
);

$entry_point_registry['setEmail'] = array(
    'file' => 'modules/HS_Facturador_proyectos/HS_Facturador_proyectos_Entrypoint.php',
    'auth' => true,
);

