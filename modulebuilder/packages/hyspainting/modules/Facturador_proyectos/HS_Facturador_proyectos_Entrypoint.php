<?php 
require_once('modules/HS_Facturador_proyectos/EmailCustom.php');
global $sugar_config, $current_user;

$idFacturadorProyecto = $_REQUEST['idFacturadorProyecto'];
$numFactura=$_REQUEST['numFactura'];
$empresa=$_REQUEST['empresa'];
$proyecto=$_REQUEST['proyecto'];

function obtenerIdNotasParaEnviarPDF($idFacturadorProyecto){
    
      $query = "SELECT 
                    p.hs_facturador_proyectos_notesnotes_idb nota_adjunto,
                    (SELECT 
                            p_s.hs_facturador_proyectos_notesnotes_idb                
                        FROM 
                                hs_facturador_proyectos_notes_c p_s
                        LEFT JOIN 
                                notes n_s
                                    ON p_s.hs_facturador_proyectos_notesnotes_idb = n_s.id
                        WHERE 
                            p_s.deleted = 0 AND  n_s.portal_flag = 0 AND 
                            p_s.hs_facturador_proyectos_noteshs_facturador_proyectos_ida = '".$idFacturadorProyecto."'
                        ORDER BY 
                            p_s.date_modified DESC
                        LIMIT 1
                    ) AS hs_facturador_proyectos_notesnotes_idb
                FROM
                       hs_facturador_proyectos_notes_c p
                INNER JOIN 
                       notes n
                        ON p.hs_facturador_proyectos_notesnotes_idb = n.id
                WHERE 
                        p.deleted = 0 AND n.portal_flag = 1 AND
                        p.hs_facturador_proyectos_noteshs_facturador_proyectos_ida =  '".$idFacturadorProyecto."'";
              
    $result = $GLOBALS['db']->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Acceder a los elementos de la fila de resultado
        $id_nota_factura = $row['hs_facturador_proyectos_notesnotes_idb'] ?? false;
        $id_nota_adjunto = $row['nota_adjunto'] ?? false;
        return array($id_nota_factura,$id_nota_adjunto);
    }
    return false;
}

$idNotes = obtenerIdNotasParaEnviarPDF($idFacturadorProyecto);

if (empty($idNotes[0])) {
    echo "La factura correspondiente no se ha creado, por lo tanto, no es posible proceder con el envío del correo electrónico.";
    return false;
} 

$emalCustom =new EmailCustom();
$admin=BeanFactory::getBean('Users','1');
$dest=$admin->email1;
$mensaje='<h3>Se adjunta datos de la factura # '.$numFactura.'</h3>';
$mensaje.='<p>Empresa destino:<b>'.$empresa.'</b></p>';
$mensaje.='<p>Contrato:<b> '.$proyecto.'</b></p>';


$asunto='Factura # '.$numFactura;
// obtener ultima factura
$adjuntoPath = $sugar_config['upload_dir'] . $idNotes[0];
$nuevoNombreAdjunto = 'Factura # '. $numFactura.'.pdf';  // Cambia el nombre según tus necesidades
$nuevoPathAdjunto = $sugar_config['upload_dir'] . $nuevoNombreAdjunto;
copy($adjuntoPath, $nuevoPathAdjunto);

// obtener adjunto 
$adjuntoPathReporteHoras = $sugar_config['upload_dir'] . $idNotes[1];
$nuevoNombreAdjuntoReporteHoras = 'Reporte de Horas de Trabajadores Factura #'. $numFactura.'.pdf';  // Cambia el nombre según tus necesidades
$nuevoPathAdjuntoReporteHoras = $sugar_config['upload_dir'] . $nuevoNombreAdjuntoReporteHoras;
copy($adjuntoPathReporteHoras, $nuevoPathAdjuntoReporteHoras);

$adjuntos = [$nuevoPathAdjunto,$nuevoPathAdjuntoReporteHoras];
try {
    $data = $emalCustom->sendEmailWithAttachments($dest, $mensaje, $asunto, $adjuntos);

    if ($data) {
        echo "El correo se envió correctamente.";
        unlink($nuevoPathAdjunto);
        unlink($nuevoPathAdjuntoReporteHoras);
    } else {
        echo "Hubo un problema al enviar el correo.";
        unlink($nuevoPathAdjunto);
        unlink($nuevoPathAdjuntoReporteHoras);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}




return $data;