<?php 
require_once('modules/HS_Facturador_proyectos/EmailCustom.php');
global $sugar_config, $current_user;
$emalCustom =new EmailCustom();
$admin=BeanFactory::getBean('Users','1');
$dest=$admin->email1;

$numFactura=$_REQUEST['numFactura'];
$mensaje='Se adjunta la factura # '.$numFactura;


$asunto='Factura # '.$numFactura;
$adjuntoPath = $sugar_config['upload_dir'] . $_REQUEST['idFactura'];
$nuevoNombreAdjunto = 'Factura # '. $numFactura.'.pdf';  // Cambia el nombre según tus necesidades
$nuevoPathAdjunto = $sugar_config['upload_dir'] . $nuevoNombreAdjunto;

copy($adjuntoPath, $nuevoPathAdjunto);
$adjuntos = [$nuevoPathAdjunto];
try {
    $data = $emalCustom->sendEmailWithAttachments($dest, $mensaje, $asunto, $adjuntos);

    if ($data) {
        echo "El correo se envió correctamente.";
        unlink($nuevoPathAdjunto);
    } else {
        echo "Hubo un problema al enviar el correo.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

return $data;