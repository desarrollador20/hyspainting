<?php


class HS_Reportes_personalizadosController extends SugarController
{

    public function action_setreportesusuarios()
    {
        $this->view = 'reportesusuarios';
    }

    public function action_setreportesproyectos()
    {
        $this->view = 'reportesproyectos';
    }




    public function getReporteUser($id_trabajador, $desde, $hasta)
    {

        $registro = [];
        $query = "SELECT 
                        project.name AS nombre_proyecto,
                        project.id AS id_proyecto,
                        hs_registro_horas.dia AS dia, 
                        horas_trabajo AS horas_trabajo, 
                        hs_registro_horas.horas_viaje AS horas_viaje, 
                        hs_registro_horas.fecha AS fecha, 
                        users_cstm.valor_hora_c AS valor_hora,
                        project_cstm.pagos_extra_c AS pago_extra,
                        COALESCE(project_cstm.max_pago_horas_viaje_proyect_c,0) AS max_horas_viaje_proyecto,
                        COALESCE(project_cstm.max_pago_horas_viaje_usuario_c,0) AS max_horas_viaje_usuario
                FROM 
                    hs_registro_horas
                LEFT JOIN 
                        project 
                            ON hs_registro_horas.project_id_c= project.id
                LEFT JOIN 
                        users_cstm 
                            ON hs_registro_horas.user_id_c=users_cstm.id_c
                LEFT JOIN 
                        project_cstm 
                            ON project.id = project_cstm.id_c
                WHERE 
                        hs_registro_horas.deleted=0 and hs_registro_horas.user_id_c='{$id_trabajador}'
                        and hs_registro_horas.fecha  BETWEEN '{$desde}' AND '{$hasta}'
                ORDER BY 
                        hs_registro_horas.fecha ASC";

        $rs = $GLOBALS['db']->query($query);

        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            // Add the date count to the current record
            $registro[] = [
                'nombre_proyecto' => $row['nombre_proyecto'],
                'dia' => $row['dia'],
                'horas_trabajo' => $row['horas_trabajo'],
                'horas_viaje' => $row['horas_viaje'],
                'fecha' => $row['fecha'],
                'valor_hora' => $row['valor_hora'],
                'pago_extra' => $row['pago_extra'],
                'max_horas_viaje_proyecto' => $row['max_horas_viaje_proyecto'],
                'max_horas_viaje_usuario' => $row['max_horas_viaje_usuario'],
                'id_proyecto' => $row['id_proyecto']

            ];
        }
        $dateCounts = $this->countDatesOccurrencesAndSumHours($registro);
        $prestamos = $this->getPrestamosUsuarios($id_trabajador, $desde, $hasta);
        return [$registro, $dateCounts, $prestamos];
    }


    private function countDatesOccurrencesAndSumHours($registro)
    {
        $dateCounts = [];
        $hoursSum = []; // Para mantener la suma de horas de viaje y trabajo
        foreach ($registro as $record) {
            $fecha = $record['fecha'];
            $horas_viaje = ((float)$record['horas_viaje'] > (float)$record['max_horas_viaje_usuario']) ? (float)$record['max_horas_viaje_usuario'] : (float)$record['horas_viaje'];

            if (array_key_exists($fecha, $dateCounts)) {
                $dateCounts[$fecha]++; // Incrementa el contador
                // Suma las horas de viaje y trabajo para la fecha actual
                $hoursSum[$fecha] += (strpos($record['pago_extra'], "travel") !== false) 
                  ? 
                    (float)$record['horas_trabajo'] + $horas_viaje
                  : 
                    (float)$record['horas_trabajo'];
            } else {
                $dateCounts[$fecha] = 1; // Inicializa el contador a 1
                // Inicializa la suma de horas de viaje y trabajo para la fecha actual
                $hoursSum[$fecha] += (strpos($record['pago_extra'], "travel") !== false)  
                  ? 
                    (float)$record['horas_trabajo'] + $horas_viaje
                  : 
                    (float)$record['horas_trabajo'];
            }
        }
        // Devuelve un arreglo que contiene tanto el contador de fechas como la suma de horas
        return ['dateCounts' => $dateCounts, 'hoursSum' => $hoursSum];
    }
    //public function getReporteProyecto($id_proyecto, $mesSeleccionado, $year, $corteSeleccionado)


    public function getReporteProyecto($data)
    {
        $id_proyecto = $data['id_proyecto'];
        if (isset($data['year'])) {
            $year = $data['year'];
            $corteSeleccionado = $data['corte'];
            $mesSeleccionado = $data['mes'];
            $project = BeanFactory::getBean('Project', $id_proyecto);
            $corte = $project->dias_corte_c;
            $mes = strlen($mesSeleccionado);
            $mesSeleccionado = $mes == 1 ? $mesSeleccionado = '0' . $mesSeleccionado : $mesSeleccionado;

            switch ($corte) {
                case 15:
                    $diaInicio = ($corteSeleccionado == 1) ? '01' : '16';
                    $fechaInicial = date('Y-m-d', strtotime("{$year}-{$mesSeleccionado}-{$diaInicio}"));
                    $fechaFinal = date('Y-m-d', strtotime($fechaInicial . ' +14 days'));
                    if ($diaInicio == '16') {
                        $ultimoDiaMes = date('Y-m-t', strtotime($fechaInicial));  // Obtiene el último día del mes
                        $fechaFinal = date('Y-m-d', strtotime($ultimoDiaMes));
                    }
                    break;

                case 25:
                    $fechaAnterior = date('Y-m-d', strtotime("{$year}-{$mesSeleccionado}-01 -1 month"));
                    $fechaInicial = date('Y-m-d', strtotime("{$fechaAnterior} +24 days"));
                    $fechaFinal = date('Y-m-d', strtotime($fechaInicial . ' +16 days'));
                    if ($corteSeleccionado == 2) {

                        $fechaInicial = $fechaFinal;
                        $fechaFinal = date('Y-m-d', strtotime("{$year}-{$mesSeleccionado}-24"));
                    }
                    if ($corteSeleccionado == 1) {
                        $fechaFinal = date('Y-m-d', strtotime($fechaFinal . ' -1 days'));
                    }
                    break;
            }
        } else {
            $fechaInicial = $data['desde'];
            $fechaFinal = $data['hasta'];
        }
        return $this->getUserProyecto($fechaInicial, $fechaFinal, $id_proyecto);
    }


    private function getUserProyecto($desde, $hasta, $proyecto)
    {
        $query = "SELECT 
                        hs_registro_horas.user_id_c AS usuario_id,
                        hs_registro_horas.dia AS dia, 
                        horas_trabajo AS horas_trabajo, 
                        hs_registro_horas.horas_viaje AS horas_viaje, 
                        hs_registro_horas.fecha AS fecha, 
                        users_cstm.valor_hora_c AS valor_hora,
                        users_cstm.puesto_c AS puesto,
                        project_cstm.pagos_extra_c AS pago_extra,
                        COALESCE(project_cstm.max_pago_horas_viaje_proyect_c,0) AS max_horas_viaje_proyecto,
		                COALESCE(project_cstm.max_pago_horas_viaje_usuario_c,0) AS max_horas_viaje_usuario,
                        users.first_name AS nombres,
                        users.last_name AS apellidos
                FROM 
                    hs_registro_horas
                LEFT JOIN 
                    project 
                     ON hs_registro_horas.project_id_c= project.id
                LEFT JOIN 
                    users_cstm 
                     ON hs_registro_horas.user_id_c=users_cstm.id_c
                LEFT JOIN 
                    project_cstm 
                     ON project.id = project_cstm.id_c
                LEFT JOIN 
                    users 
                     ON users_cstm.id_c= users.id
                WHERE  
                     hs_registro_horas.deleted=0 and hs_registro_horas.project_id_c='$proyecto' AND 
                     hs_registro_horas.fecha  BETWEEN '{$desde}' AND '{$hasta}'
                ORDER BY 
                     hs_registro_horas.fecha ASC";
       

        $rs = $GLOBALS['db']->query($query);
        $usuarios = [];
        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            if (
                isset($row['horas_trabajo']) && trim($row['horas_trabajo']) !== '' && $row['horas_trabajo'] > 0 &&
                isset($row['horas_viaje'])
            ) {
                    $usuario = $row['usuario_id'];
                    $fecha = $row['fecha'];
                    $horas_trabajo = $row['horas_trabajo'];
                    $horas_viaje = $row['horas_viaje'];
                    $pago_extra = $row['pago_extra'];
                    $max_horas_viaje_proyecto = $row['max_horas_viaje_proyecto'];
                    $max_horas_viaje_usuario = $row['max_horas_viaje_usuario'];
                    $valor_hora = $row['valor_hora'];
                    $puesto = $row['puesto'];
                    $name = $row['nombres'] . ' ' . $row['apellidos'];
                    if (!isset($usuarios[$usuario])) {
                        // Si no existe, inicializar con un arreglo vacío
                        $usuarios[$usuario] = [];
                    }
                    // Agregar valores al arreglo del usuario
                    $usuarios[$usuario][] = [
                        'usuario' => $usuario,
                        'fecha' => $fecha,
                        'horas_trabajo' => $horas_trabajo,
                        'horas_viaje' => $horas_viaje,
                        'pago_extra' => $pago_extra,
                        'max_horas_viaje_proyecto' => $max_horas_viaje_proyecto,
                        'max_horas_viaje_usuario' => $max_horas_viaje_usuario,
                        'valor_hora' => $valor_hora,
                        'name' => $name,
                        'puesto' => $puesto

                    ];
           }
        }

        return [$usuarios, $desde, $hasta];
    }



    public function getPrestamosUsuarios($id_trabajador, $desde, $hasta)
    {
        $sql = "SELECT SUM(valor) as suma_montos FROM hs_prestamos WHERE estado = 'Activo' and deleted=0 and user_id_c='{$id_trabajador}' and fecha  BETWEEN '{$desde}' AND '{$hasta}'";
        $resultado = $GLOBALS['db']->query($sql);
        // Recupera el valor calculado
        $row = $GLOBALS['db']->fetchByAssoc($resultado);
        return $row['suma_montos'] === null ? 0 : $row['suma_montos'];
    }



    public function setFacturadorUsuarios($data)
    {
        return $data;
    }


    public function action_setFacturadorUsuarios()
    {
        global $sugar_config,$current_user;
        $dateTimeActual = new DateTime();
        // Obtener la cadena formateada de fecha y hora
        $fechaHoraActual = $dateTimeActual->format('Y-m-d H:i:s');
        // Crear el nombre de intervalo utilizando el formato especificado
        $int_name = sprintf('FR-%s', $dateTimeActual->format('Ymd-His'));

        $facturaUsuarios = BeanFactory::newBean('HS_Facturador');
        $facturaUsuarios->name = $int_name;
        $facturaUsuarios->desde = $_POST['desde'];
        $facturaUsuarios->hasta = $_POST['hasta'];
        $facturaUsuarios->user_id_c = $_POST['id_trabajador'];
        $facturaUsuarios->valor_pagar = $_POST['subtotal'];
        $facturaUsuarios->descuentos = $_POST['prestamos'];
        $facturaUsuarios->total = $_POST['total'];
        $facturaUsuarios->pagado = 'No';
        $facturaUsuarios->save();

        if (isset($_POST['pdf'])) {
            $nombre_archivo = 'pdf_registro_horas_usuario_'.rand(1000, 9999).'.pdf';
            $rutaArchivo = $sugar_config['upload_dir']  . $nombre_archivo;
            $note = BeanFactory::newBean('Notes');
            $note->modified_user_id = $current_user->id;
            $note->created_by = $current_user->id;
            $note->name = 'Valor Factura: $' .  number_format($_POST['total'], 2, '.', ',');
            $note->parent_type = "HS_Facturador";
            $note->parent_id = $facturaUsuarios->id;
            $note->file_mime_type = 'application/pdf';
            $note->filename =  $nombre_archivo;
            $note->save();

            $pdfDecodificado = base64_decode($_POST['pdf']);
           
            file_put_contents($rutaArchivo, $pdfDecodificado);
            rename( $rutaArchivo, $sugar_config['upload_dir'] . $note->id);
            $facturaUsuarios->load_relationship('hs_facturador_notes');
            $facturaUsuarios->hs_facturador_notes->add($note);
            
        }

        echo "<script>
                alert('¡Reporte Guardado con exito!');
                window.location.href = 'index.php?module=HS_Reportes_personalizados&action=setreportesusuarios&data=exito';
            </script>";

       // SugarApplication::redirect('index.php?module=HS_Reportes_personalizados&action=setreportesusuarios&data=exito');

        // return $data;
    }
    public function verificarFacturaUsuarios($data)
    {
        $usuario = $data['id_trabajador'];
        $fecha_desde = $data['desde'];
        $fecha_hasta = $data['hasta'];
        $estado = 'false';
        $modulo = strtolower($data['modulo']);
        $campo = $modulo == 'hs_facturador' ? 'user_id_c' : 'project_id_c';
        $id = false;
        $sql = "SELECT * FROM {$modulo} 
        WHERE {$campo} = '$usuario' 
        AND (
            (desde <= '$fecha_desde' AND hasta >= '$fecha_hasta') OR
            (desde >= '$fecha_desde' AND hasta <= '$fecha_hasta') OR
            (desde <= '$fecha_hasta' AND hasta >= '$fecha_hasta')
        ) And deleted=0";
        $result = $GLOBALS['db']->query($sql);
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            if ($row['desde'] == $fecha_desde  && $row['hasta'] == $fecha_hasta) {
                $estado = 'Existe ya un registro de Facturador con las mismas fechas';
            } else {
                $estado = 'Existe ya fechas registradas el el mismo rango';
            }
            $id = $row['id'];

            break;
        }

        return [$estado, $id];
    }




    public function getInfoProyecto($idProyecto)
    {
        $proyecto = BeanFactory::getBean('Project', $idProyecto);
        $result = [
            'tipo_cobro'     => $proyecto->tipo_cobro_c,
            'valor_contrato' => $proyecto->valor_contrato_c,
            'valor_pagar'    => json_decode(html_entity_decode($proyecto->valores_pagar_c)),
        ];
        return $result;
    }

    public function guardarPDFRegistroHoras($archivoPdf,$data){

        global $sugar_config, $current_user;

            if (isset($archivoPdf['pdf']) && $archivoPdf['pdf']['error'] == 0) {
                $note = BeanFactory::newBean('Notes');
                $note->modified_user_id = $current_user->id;
                $note->created_by = $current_user->id;
                $note->name = $archivoPdf['pdf']['name'];
                $note->parent_type = "HS_Facturador_proyectos";
                $note->parent_id = $data["id_facturador_proyecto"];
                $note->file_mime_type = 'application/pdf';
                $note->filename = $archivoPdf['pdf']['name'];
                $note->portal_flag = 1;
                $note->save();
               
                $tmpNombre = $archivoPdf['pdf']['tmp_name']; 
                $nombre_archivo = $archivoPdf['pdf']['name']."_temp_".rand(1000, 9999);
                $rutaDestino = $sugar_config['upload_dir'].$nombre_archivo;
                move_uploaded_file($tmpNombre,$rutaDestino);
                rename($rutaDestino, $sugar_config['upload_dir'] . $note->id);
                $Facturador_Proyecto = BeanFactory::getBean('HS_Facturador_proyectos', $data["id_facturador_proyecto"]);
                $Facturador_Proyecto->load_relationship('hs_facturador_proyectos_notes');
                $Facturador_Proyecto->hs_facturador_proyectos_notes->add($note);
                return $note->id;
          }
       
        
    }


    public function setFacturadorProyectos($data)
    {
        $idProyecto = $data['id_proyecto'];
        $dateTimeActual = new DateTime();
        // Obtener la cadena formateada de fecha y hora
        $fechaHoraActual = $dateTimeActual->format('Y-m-d H:i:s');
        // Crear el nombre de intervalo utilizando el formato especificado
        $int_name = sprintf('FRP-%s', $dateTimeActual->format('Ymd-His'));
        $proyecto = BeanFactory::getBean('Project', $idProyecto);

        $valorPagado = $proyecto->valor_pagado_c + $data['valor_pagado'];
        $proyecto->valor_pagado_c = $valorPagado;
        $corteProyecto = $proyecto->dias_corte_c;

        $facturadorP = BeanFactory::newBean('HS_Facturador_proyectos');
        $facturadorP->name = $int_name;
        $facturadorP->account_id_c = $proyecto->account_id_c;
        $facturadorP->project_id_c = $idProyecto;
        $facturadorP->desde = $data['desde'];
        $facturadorP->hasta = $data['hasta'];
        $facturadorP->fecha_corte = $this->setFechaCorte($data['tipo_fecha'], $corteProyecto, $data['corte']);
        $facturadorP->n_horas = $data['total_horas'];
        $facturadorP->fecha_proximo_reporte = $this->setFechaProximoCorte($data['tipo_fecha'], $corteProyecto, $data['corte']);
        $totalesAux=$this->setTable($data['info'], $data['tipo_cobro']);
       // $facturadorP->data = $this->setTable($data['info'], $data['tipo_cobro']);
        //$facturadorP->valor_total = $data['valor_pagado'];
        $facturadorP->valor_total = $totalesAux[0];
        $facturadorP->encabezado=json_encode($data['info']);
        $facturadorP->num_factura = $this->getConsecutivo();
        $proyecto->save();
        $facturadorP->save();
        //return $data['info'];
        return $facturadorP->id;
    }

    private function setFechaCorte($tipo, $corteProyecto, $corte)
    {
        $valor = 0;
        if ($tipo == 'true') {
            if ($corteProyecto == 15) {
                $valor = ($corte == 1) ? 15 : 30;
            } elseif ($corteProyecto == 25 && ($corte == 1 || $corte == 2)) {
                $valor = 25;
            }
        } else {
            $fechaActual = new DateTime();
            // Restar un día
            $fechaAnterior = $fechaActual->modify('-1 day');
            // Obtener la fecha formateada
            $valor = $fechaAnterior->format('Y-m-d');
        }
        return $valor;
    }

    private function setFechaProximoCorte($tipo, $corteProyecto, $corte)
    {
        $valor = 0;
        if ($tipo == 'true') {
            if ($corteProyecto == 15) {
                $valor = ($corte == 1) ? 15 : 30;
            } elseif ($corteProyecto == 25 && ($corte == 1 || $corte == 2)) {
                $valor = 25;
            }
        } else {
            $fechaActual = new DateTime();
            // Restar un día
            $fechaAnterior = $fechaActual->modify('+15 days');
            // Obtener la fecha formateada
            $valor = $fechaAnterior->format('Y-m-d');
        }
        return $valor;
    }


    private function getConsecutivo()
    {
        $sql = "SELECT COALESCE(MAX(num_factura) + 1, 1) AS ultimo_consecutivo
        FROM hs_facturador_proyectos";

        $db = DBManagerFactory::getInstance();
        $dataSql = $db->query($sql);
        $row = $db->fetchRow($dataSql);

        return (int)$row['ultimo_consecutivo'];
    }


    private function setTable($valores, $tipoCobro)
    {
        // $valor = json_decode($valores);
        $lista = $GLOBALS['app_list_strings']['hs_valores_pagar'];
       
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
                    if ($otHours > 0) {
                        $lineTotalOt = ($unitPrice * $otHours) * 1.5;
                    }
                    $unido = $lineTotalReg + $lineTotalOt;
                    $total += $unido;
                    $lineTotalOt = 0;
                    $lineTotalReg = 0;
                }
            }
        } else {
            $unit = $valores[0][$tipoCobro]['unitPrice'];
            $value = $valores[0][$tipoCobro]['regular_hours'];
            $total = $unit;
        }
        return [$total];
    }


    private  function setTbodyTable($valores)
    {
    }
}
