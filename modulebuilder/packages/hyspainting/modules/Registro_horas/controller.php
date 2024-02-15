<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class HS_Registro_horasController  extends SugarController
{



    public function action_setregistrohoras()
    {

        $this->view = 'setregistrohoras';
    }


    public function action_saveregistrohoras()
    {
        global $current_user;

        if (isset($_POST['regla'])) {
            //Obtener el arreglo con los identificadores de las variables
            $_reglas = $_POST['regla'];
            //Retiramos el primer elemento por tratarse del repositorio
            array_shift($_reglas);
            //Declaramos la variable donde guardaremos el campo

            //Recorrer el arreglo de identificadores
            // $updates = array();
            $datos = array();
            $datos2 = array();

            $sql = "INSERT INTO hs_registro_horas_audit";
            $values = array(
                'id' => '0',
                'parent_id' => '0',
                'field_name' => '',
                'data_type' => 'decimal',
                'before_value_string' => '',
                'after_value_string' => '',
                'date_created' => TimeDate::getInstance()->nowDb(),
                'created_by' => $current_user->id
            );
            $sql .= "(" . implode(",", array_keys($values)) . ") VALUES";
            foreach ($_reglas as $item) {

                if ($_POST['registro_id_' . $item] != "0") {
                    $registo_horas = BeanFactory::getBean('HS_Registro_horas', $_POST['registro_id_' . $item]);
                    /* desde getBean no permite actualizar los valores decimales, quita la parte decimal error de suite
                    por eso se opta por hacer actualziacion masiva sql
                    $registo_horas=BeanFactory::getBean('HS_Registro_horas',$_POST['registro_id_'.$item]);
                    $registo_horas->horas_viaje=$_POST['horas_viaje_'.$item];
                    $registo_horas->horas_trabajo=(float)$_POST['horas_trabajo_'.$item];
                    $registo_horas->save(); */
                    // Agregar los datos de actualización a los arrays
                    $registroId = $_POST['registro_id_' . $item];
                    $horasViaje = (float)$_POST['horas_viaje_' . $item];
                    $horasTrabajo = (float)$_POST['horas_trabajo_' . $item];
                    $updates = "UPDATE hs_registro_horas SET horas_viaje = $horasViaje, horas_trabajo = $horasTrabajo WHERE id = '{$registroId}'";
                    $GLOBALS['db']->query($updates);

                    /*insertar la auditoria horas de trabajo */
                    $values['id'] = create_guid();
                    $values['parent_id'] = $registroId;
                    $values['field_name'] = 'horas_trabajo';
                    if (isset($registo_horas->horas_trabajo)){
                    $values['before_value_string'] = $registo_horas->horas_trabajo;
                    }
                    $values['after_value_string'] = $horasTrabajo;
                    $datos[] = "('" . implode("','", $values) . "')";
                    /*insertar la auditoria horas de viaje */
                    $values['id'] = create_guid();
                    $values['field_name'] = 'horas_viaje';
                    if (isset($registo_horas->horas_viaje)){
                    $values['before_value_string'] = $registo_horas->horas_viaje;
                    }
                    $values['after_value_string'] = $horasViaje;
                    $datos2[] = "('" . implode("','", $values) . "')";
                } else {
                  
                    if((float)($_POST['horas_trabajo_' . $item])>0 && isset($_POST['project_' . $item])){
                    $registo_horas = BeanFactory::newBean('HS_Registro_horas');
                    $registo_horas->horas_viaje = (float)($_POST['horas_viaje_' . $item]);
                    $registo_horas->horas_trabajo = (float)($_POST['horas_trabajo_' . $item]);
                    $registo_horas->project_id_c = $_POST['project_' . $item];
                    $registo_horas->user_id_c = $current_user->id;
                    $registo_horas->dia = $_POST['dia_' . $item];
                    $registo_horas->fecha = $_POST['fecha_' . $item];
                    $registo_horas->name='PR-'.$_POST['fecha_' . $item];
                    $registo_horas->save();
                    }
                }
            }

            $sql .= implode(", ", $datos);
            $sql .= ',' . implode(", ", $datos2);
            $GLOBALS['db']->query($sql);
            echo '<script>alert(" Registro Guardado correctamente ' . $_POST['rango'] . '");</script>';
            $this->view = 'setregistrohoras';
        }
    }

    public function getRegistrosinicial($fechas)
    {

        global $current_user;
        $fechas = explode(",", $fechas);
        $registros = array();
        $query = "SELECT id,fecha,dia,project_id_c,horas_trabajo, horas_viaje FROM hs_registro_horas WHERE fecha >= '{$fechas[0]}' AND fecha <= '{$fechas[1]}' 
     AND deleted=0 AND user_id_c='{$current_user->id}' ORDER BY fecha ASC";
        $rs = $GLOBALS['db']->query($query);
        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            $registros[] = $row;
        }

        return $registros;
    }

    public function getRegistros($fechas)
{
    global $current_user;
    $fechas = explode(",", $fechas);
    $registros = array();

    // Consulta SQL para obtener los registros existentes en el rango de fechas
    $query = "SELECT id, fecha, dia, project_id_c, horas_trabajo, horas_viaje FROM hs_registro_horas WHERE fecha >= '{$fechas[0]}' AND fecha <= '{$fechas[1]}' AND deleted=0 AND user_id_c='{$current_user->id}' ORDER BY fecha ASC";
    $rs = $GLOBALS['db']->query($query);

    while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
        $registros[] = $row;
    }

    // Crear un arreglo de fechas existentes
    $fechasExistentes = array();

    foreach ($registros as $registro) {
        $fechasExistentes[] = $registro['fecha'];
    }

    // Construir un arreglo de fechas dentro del rango
    $fechaInicio = new DateTime($fechas[0]);
    $fechaFin = new DateTime($fechas[1]);
    $interval = new DateInterval('P1D');
    
    // Ajustar la fecha de fin para que sea el día después de la fecha final
    $fechaFin->add($interval);
    
    $period = new DatePeriod($fechaInicio, $interval, $fechaFin);

    // Días de la semana en español
    $diasSemana = array(
        'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'
    );

    // Agregar días faltantes al arreglo de registros
    foreach ($period as $fecha) {
        $fechaActual = $fecha->format('Y-m-d');
        $diaSemana = $diasSemana[$fecha->format('w')];

        if (!in_array($fechaActual, $fechasExistentes)) {
            $registros[] = array(
                'id' => 0,
                'fecha' => $fechaActual,
                'dia' => $diaSemana,
                'project_id_c' => '',
                'horas_trabajo' => '',
                'horas_viaje' => ''
            );
        }
    }

    usort($registros, function($a, $b) use ($diasSemana) {
        $indexA = array_search($a['dia'], $diasSemana);
        $indexB = array_search($b['dia'], $diasSemana);
        return $indexA - $indexB;
    });

    return $registros;
}





    private function guardarAuditoria()
    {
    }
}
