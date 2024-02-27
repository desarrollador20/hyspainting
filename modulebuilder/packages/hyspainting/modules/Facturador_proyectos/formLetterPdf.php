<?php
use SuiteCRM\PDF\Exceptions\PDFException;
use SuiteCRM\PDF\PDFWrapper;

require_once('modules/AOS_PDF_Templates/templateParser.php');
require_once('modules/AOS_PDF_Templates/AOS_PDF_Templates.php');
require_once('modules/HS_Facturador_proyectos/EmailCustom.php');

global $sugar_config, $current_user;

$bean = BeanFactory::getBean($_REQUEST['module']);

if (!$bean) {
    sugar_die("Invalid Module");
}

$recordIds = array();

if (isset($_REQUEST['current_post']) && $_REQUEST['current_post'] != '') {
    $order_by = '';
    require_once('include/MassUpdate.php');
    $mass = new MassUpdate();
    $mass->generateSearchWhere($_REQUEST['module'], $_REQUEST['current_post']);
    $ret_array = create_export_query_relate_link_patch($_REQUEST['module'], $mass->searchFields, $mass->where_clauses);
    $query = $bean->create_export_query($order_by, $ret_array['where'], $ret_array['join']);
    $result = DBManagerFactory::getInstance()->query($query, true);
    $uids = array();
    while ($val = DBManagerFactory::getInstance()->fetchByAssoc($result, false)) {
        $recordIds[] = $val['id'];
    }
} else {
    $recordIds = explode(',', $_REQUEST['uid']);
}


$template = BeanFactory::getBean('AOS_PDF_Templates', $_REQUEST['templateID']);

if (!$template) {
    sugar_die("Invalid Template");
}

$fecha_hora_actual = date('Y-m-d');
$file_name = str_replace(" ", "_", $template->name .'_'.$fecha_hora_actual) . ".pdf";

$pdfConfig = [
    'mode' => 'en',
    'page_size' => $template->page_size,
    'font' => 'DejaVuSansCondensed',
    'margin_left' => $template->margin_left,
    'margin_right' => $template->margin_right,
    'margin_top' => $template->margin_top,
    'margin_bottom' => $template->margin_bottom,
    'margin_header' => $template->margin_header,
    'margin_footer' => $template->margin_footer,
    'orientation' => $template->orientation
];

try {
    $pdf = PDFWrapper::getPDFEngine();
    $pdf->configurePDF($pdfConfig);
} catch (PDFException $e) {
    LoggerManager::getLogger()->warn('PDFException: ' . $e->getMessage());
}
$count = 0;
foreach ($recordIds as $recordId) {
    $bean->retrieve($recordId);

    try {
        $pdfHistory = PDFWrapper::getPDFEngine();
        $pdfHistory->configurePDF($pdfConfig);
    } catch (PDFException $e) {
        LoggerManager::getLogger()->warn('PDFException: ' . $e->getMessage());
    }

    $object_arr = array();
    $object_arr[$bean->module_dir] = $bean->id;

    if ($bean->module_dir === 'Contacts') {
        $object_arr['Accounts'] = $bean->account_id;
    }

    $search = array(
        '@<script[^>]?>.?</script>@si',        // Strip out javascript
        '@<[\/\!]?[^<>]?>@si',        // Strip out HTML tags
        '@([\r\n])[\s]+@',            // Strip out white space
        '@&(quot|#34);@i',            // Replace HTML entities
        '@&(amp|#38);@i',
        '@&(lt|#60);@i',
        '@&(gt|#62);@i',
        '@&(nbsp|#160);@i',
        '@&(iexcl|#161);@i',
        '@<address[^>]*?>@si'
    );

    $replace = array(
        '',
        '',
        '\1',
        '"',
        '&',
        '<',
        '>',
        ' ',
        chr(161),
        '<br>'
    );

    $aux = json_decode(html_entity_decode($bean->encabezado), true);

    $proyecto = BeanFactory::getBean('Project', $bean->project_id_c);
    $desde  = DateTime::createFromFormat('m/d/Y', $bean->desde)->format('Y-m-d');
    $result = [];
    if ($bean->fecha_corte == 25) {
        $query = "SELECT
        encabezado,
        valor_total
        FROM
        hs_facturador_proyectos
        WHERE
        deleted = 0
        AND project_id_c = '{$bean->project_id_c}'
        AND fecha_corte = 25
        AND hasta = DATE_SUB('{$desde}', INTERVAL 1 DAY)";
        $rs = $GLOBALS['db']->query($query);
        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            $result[] = [
                'data' => json_decode(html_entity_decode($row['encabezado']), true),
                'total' => $row['valor_total']
            ];
        }
    }
    $subtotal=$aux;
    if (count($result) > 0) {
        $subtotal = array_merge_recursive($result[0]['data'], $aux);
    }
    $data = getTabla($subtotal, $proyecto->tipo_cobro_c);
    $bean->data = $data[0];
    //$bean->valor_total = $data[1];
    $bean->save();
    $bean->fecha_creacion = date("F j, Y", strtotime($bean->fecha_creacion));


    $bean->data = preg_replace($search, $replace, $bean->data);
    $bean->data = templateParser::parse_template($bean->data, $object_arr);
    $text = preg_replace($search, $replace, $template->description);


    $text = preg_replace_callback(
        '/{DATE\s+(.*?)}/',
        function ($matches) {
            return date($matches[1]);
        },
        $text
    );

    $header = preg_replace($search, $replace, $template->pdfheader);
    $footer = preg_replace($search, $replace, $template->pdffooter);

    $converted = templateParser::parse_template($text, $object_arr);
    $header = templateParser::parse_template($header, $object_arr);
    $footer = templateParser::parse_template($footer, $object_arr);



    //$printable = str_replace("\n", "<br />", $converted);
    $printable=$converted;

    try {
        $note = BeanFactory::newBean('Notes');
        $note->modified_user_id = $current_user->id;
        $note->created_by = $current_user->id;
        $note->name = 'Factura N° ' . $bean->num_factura;
        $note->parent_type = $bean->module_dir;
        $note->parent_id = $bean->id;
        $note->file_mime_type = 'application/pdf';
        $note->filename = 'Factura_'.$bean->num_factura.".pdf";
        if ($bean->module_dir == 'Contacts') {
            $note->contact_id = $bean->id;
            $note->parent_type = 'Accounts';
            $note->parent_id = $bean->account_id;
        }
        $note->save();

        $fp = fopen($sugar_config['upload_dir'] . 'nfile.pdf', 'wb');
        fclose($fp);

        $pdfHistory->writeHeader($header);
        $pdfHistory->writeFooter($footer);
        $pdfHistory->writeHTML($printable);
        $pdfHistory->outputPDF($sugar_config['upload_dir'] . 'nfile.pdf', 'F', $note->name);

        if ($count > 0) {
            $pdf->writeBlankPage();
        }
        $pdf->writeHeader($header);
        $pdf->writeFooter($footer);
        $pdf->writeHTML($printable);

        rename($sugar_config['upload_dir'] . 'nfile.pdf', $sugar_config['upload_dir'] . $note->id);
        $bean->load_relationship('hs_facturador_proyectos_notes');
        $bean->hs_facturador_proyectos_notes->add($note);
    } catch (PDFException $e) {
        LoggerManager::getLogger()->warn('PDFException: ' . $e->getMessage());
    }
    ++$count;
}


/*
$emalCustom =new EmailCustom();
$dest='july27may@gmail.com';
$mensaje='prueba';
$adjuntos=[$sugar_config['upload_dir'] . $note->id];
$asunto='Prueba';
$emalCustom->sendEmailWithAttachments($dest,$mensaje,$asunto, $adjuntos);
*/

$pdf->outputPDF($file_name, 'D');


function getTabla($valores, $tipoCobro)
{
    // $valor = json_decode($valores);
    $lista = $GLOBALS['app_list_strings']['hs_valores_pagar'];
    $data = '<table style="width: 670px; padding-top: 7px; ">
        <tbody>
        
            <tr>
                <td style="width: 10%;"><strong><span style="font-size: small; color: #5e5b95;">QTY</span></strong></td>
                <td style="width: 60%;"><strong><span style="font-size: small; color: #5e5b95;">DESCRIPTION</span></strong></td>
                <td align="right" style="width: 15%;"><strong><span style="font-size: small; color: #5e5b95;">UNIT PRICE</span></strong></td>
                <td align="right" style="width: 15%;"><strong><span style="font-size: small; color: #5e5b95;">LINE TOTAL</span></strong></td>
            </tr>';

    $lineTotalOt = 0;
    $total = 0;
    $tax = 0;
    if ($tipoCobro === 'por_horas') {
        foreach ($valores  as $item) {
            foreach ($item as $puesto => $values) {
                $regHours = $values['regular_hours'];
                $unitPrice = $values['unitPrice'];
                $otHours = $values['overtime_hours'];
                // Calcular el total de la línea
                $lineTotalReg = $unitPrice * $regHours;
                $data .= '    <tr>
                <td style="font-size: small;">' . $regHours . '</td>
                <td style="font-size: small;"> Regular Hours ' . $lista[$puesto] . ' Week Ending ' . $values['fecha'] . '</td>
                <td align="right" style="font-size: small;">$' . number_format($values['unitPrice'], 2, '.', ',') . '</td>
                <td align="right" style="font-size: small;">$ ' . number_format($lineTotalReg, 2, '.', ',') . ' </td>';

                if ($otHours > 0) {
                    $lineTotalOt = ($unitPrice * $otHours) * 1.5;
                    $data .= '    <tr>
                    <td style="font-size: small;">' . $otHours . ' </td>
                    <td style="font-size: small;"> Overtime Hours ' . $lista[$puesto] . ' Week Ending ' . $values['fecha'] . '</td>
                    <td align="right" style="font-size: small;">$' . number_format($values['unitPrice'], 2, '.', ',') . '</td>
                    <td align="right" style="font-size: small;">$ ' . number_format($lineTotalOt, 2, '.', ',') . ' </td>';
                }
                $unido = $lineTotalReg + $lineTotalOt;
                $data .= '</tr>';
                $total += $unido;
                $lineTotalOt = 0;
                $lineTotalReg = 0;
            }
        }
    } else {
        $unit = $valores[0][$tipoCobro]['unitPrice'];
        $value = $valores[0][$tipoCobro]['regular_hours'];
        $data .= '<tr>
            <td style="font-size: small;">' . $value . '</td>
            <td style="font-size: small;">$hs_facturador_proyectos_description</td>
            <td align="right" style="font-size: small;">$' . number_format($unit, 2, '.', ',') . '</td>
            <td align="right" style="font-size: small;">$ ' . number_format($unit, 2, '.', ',') . '</td></tr>';
        for ($i = 0; $i < 10; $i++) {
            $data .= '<tr>
                <td style="font-size: small;"></td>
                <td style="font-size: small;"></td>
                <td style="font-size: small;"></td>
                <td style="font-size: small;"></td></tr>';
        }

        $total = $unit;
    }
    $data .= '<tr>
            <td colspan="2"></td>
            <td><strong><span style="font-size: small; color: #5e5b95;">SUBTOTAL</span></strong></td>
            <td align="right" style="font-size: small;background-color: #e6efea"><b>$' . number_format($total, 2, '.', ',') . '</b></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><strong><span style="font-size: small; color: #5e5b95;">SALEX TAX</span></strong></td>
            <td align="right" style="font-size: small;background-color: #e6efea"><b>$' . $tax . '</b></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><strong><span style="font-size: small; color: #5e5b95;">TOTAL</span></strong></td>
            <td align="right" style="font-size: small;background-color: #e6efea"><b>$' . number_format($total, 2, '.', ',') . '</b></td>
        </tr>
        </tbody>
        </table>';


    return [$data,$total];
}