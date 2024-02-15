<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require 'modules/HS_Programador/excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HS_ProgramadorHooks
{

    public function guardarData($bean, $event, $arguments)
    {
     
      
        global $current_user;
        $db = DBManagerFactory::getInstance();
        $bol = BeanFactory::getBean('HS_Registro_horas');
        $now = TimeDate::getInstance()->nowDb();
        $excel=array();
        if (isset($_POST['regla'])) {
            $_data = $_POST['regla'];
            array_shift($_data);
            foreach ($_data as $item) {
                $fecha =$bean->fecha;
                $aux = $db->insertParams(
                    $bol->getTableName(),
                    $bol->getFieldDefinitions(),
                    array(
                        'id' => create_guid(),
                        'date_entered' => $now,
                        'date_modified' => $now,
                        'name'=>'PR-'.$fecha,
                        'modified_user_id' =>$current_user->id,
                        'created_by' =>$current_user->id,
                        'deleted' => 0,
                        'dia'=> $this->getNameday($bean->fecha),
                        'fecha' =>  $fecha,
                        'project_id_c' =>  $_POST['proyecto_id_' . $item],
                        'user_id_c' => $_POST['usuario_id_' . $item],
                    ),
                    isset($bol->field_name_map) ? $bol->field_name_map : null,
                    false
                );
                //Extraer las partes
                $aux = explode("VALUES (", $aux);
                //Agregar a la lista de valores del al regsitro de horas
                $sql_registro_horas['registro'][] = "(" . $aux[1];
                //Si no hay sql inicial, crear
                if (!isset($sql_inicial['registro'])) {
                    $sql_inicial['registro'] = $aux[0] . " VALUES";
                }

                $temp=['proyecto'=>$_POST['proyecto_name_' . $item], 'fecha'=>$fecha, 'hora'=>$_POST['proyecto_entrada_' . $item],
                'trabajador'=>$_POST['usuario_name_' . $item], 'movil'=>$_POST['usuario_movil_' . $item]
                ];

                $excel[]=$temp;
            }
            $this->crearExcel($excel);
            foreach ($sql_registro_horas as $key => $data) {
                $sql = $sql_inicial[$key] . " " . implode(", ", $data);
                $db->query($sql);
            }
        
           
        }
      
    }

    private function getNameday($fecha)
    {
        // Convierte la cadena de fecha en un objeto DateTime
        $fecha_obj = DateTime::createFromFormat("Y-m-d", $fecha);
      

        // Obtiene el día de la semana en español utilizando strftime
        setlocale(LC_TIME, 'es_ES.utf8');
        $diaSemanaStrftime = strftime("%A", $fecha_obj->getTimestamp());
        // Obtiene el día de la semana en español utilizando date
        $diaSemanaDate = date("l", $fecha_obj->getTimestamp());
        $diaSemanaTraducido = [
            'Monday'    => 'Lunes',
            'Tuesday'   => 'Martes',
            'Wednesday' => 'Miercoles',
            'Thursday'  => 'Jueves',
            'Friday'    => 'Viernes',
            'Saturday'  => 'Sabado',
            'Sunday'    => 'Domingo'
        ];
        $diaSemanaDateTraducido = $diaSemanaTraducido[$diaSemanaDate];

        return $diaSemanaDateTraducido;
    }


    function crearExcel($data){
   
    
        // Crea una instancia de Spreadsheet
        $spreadsheet = new Spreadsheet();
        
        // Selecciona la hoja activa
        $sheet = $spreadsheet->getActiveSheet();
        
        // Agrega datos a la hoja
        $sheet->setCellValue('A1', 'Poyecto');
        $sheet->setCellValue('B1', 'Dirección');
        $sheet->setCellValue('C1', 'Fecha');
        $sheet->setCellValue('D1', 'Hora');
        $sheet->setCellValue('E1', 'Trabajador');
        $sheet->setCellValue('F1', 'Movil');
        
        $sheet->setCellValue('A2' , 'hola');
        $sheet->setCellValue('C2' , 2);
        $sheet->setCellValue('D2' ,2 );
        $sheet->setCellValue('E2' , 2);
        $sheet->setCellValue('F2' ,2);
       
        $row = 2;
        foreach ($data as $fila) {
            $sheet->setCellValue('A' . $row, $fila['proyecto']);
            $sheet->setCellValue('C' . $row, $fila['fecha']);
            $sheet->setCellValue('D' . $row, $fila['hora']);
            $sheet->setCellValue('E' . $row, $fila['trabajador']);
            $sheet->setCellValue('F' . $row, $fila['movil']);
         
            $row++;
        }
        
        // Crea un objeto Writer para guardar el archivo
        $writer = new Xlsx($spreadsheet);
        
        // Guarda el archivo en el servidor o lo descarga
        $nombre_archivo = 'datos.xlsx';
        //$writer->save($nombre_archivo);
        
        // Descarga el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombre_archivo . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');

        
  
    
	
    }

}

