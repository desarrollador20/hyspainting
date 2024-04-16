<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//Nombre del Job
$job_strings[] = 'facturasProximasVencerScheduler';

//FUnción para actualizar la edad de los usuarios (cuentas)
function facturasProximasVencerScheduler()
{    require_once('modules/HS_Facturador_proyectos/EmailCustom.php');

	$query = "SELECT 
                    f_p.num_factura,f_p.fecha_pago,f_p.valor_total,p.name name_project
              FROM 
                    hs_facturador_proyectos f_p
              INNER JOIN 
                    project p 
                     ON f_p.project_id_c = p.id
              WHERE 
                    f_p.deleted = 0 AND f_p.fecha_pago BETWEEN  DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND CURDATE() ";

	$rs = $GLOBALS['db']->query($query);
	if($rs->num_rows==0){
	  return true;
	}
   
	$htmlBody = '<p>Las siguientes facturas están próximas a vencer.<p>';
	$htmlBody .= '<html><body>';
	$htmlBody .= '<p>Detalle:</p>';
	$htmlBody .= '<table border="1">';
	$htmlBody .= '<tr>
                      <th># Factura</th>
                      <th>Fecha de pago</th>
                      <th>Proyecto</th>
                   </tr>';
	
	while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
		$htmlBody .= '<tr>';
		$htmlBody .= '<td>' . $row['num_factura']. '</td>';
		$htmlBody .= '<td>' . date("m/d/Y", strtotime($row['fecha_pago'])) . '</td>';
		$htmlBody .= '<td>' . $row['name_project'] . '</td>';
		$htmlBody .= '</tr>';
	}

	$htmlBody .= '</table>';
	$htmlBody .= '</body></html>';
	$htmlBody .= '<p>Cordial saludo</p>';


	$asunto = ' Facturas a vencer hsconstruction';
	$admin = BeanFactory::getBean('Users', '1');
	$dest = $admin->email1.",hipolito.789@hotmail.com";
	$emalCustom = new EmailCustom();
	$adjuntos = [];
	$data = $emalCustom->sendEmailWithAttachments($dest, $htmlBody, $asunto, $adjuntos);
  
	return true;

}
