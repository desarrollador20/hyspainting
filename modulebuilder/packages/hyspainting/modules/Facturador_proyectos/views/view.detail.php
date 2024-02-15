<?php
/*if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//require_once('include/MVC/View/views/view.detail.php');

require_once('modules/HS_Facturador_proyectos/formLetter.php');
formLetter::DVPopupHtml('HS_Facturador_proyectos');
?>