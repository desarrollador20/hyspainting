<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */
require 'modules/HS_Programador/excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HS_Programador extends Basic
{
    public $new_schema = true;
    public $module_dir = 'HS_Programador';
    public $object_name = 'HS_Programador';
    public $table_name = 'hs_programador';
    public $importable = true;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $SecurityGroups;
    public $fecha;
    public $programacion;
    public $estado_envio;
	
    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }

    public function save($check_notify=false)
    {
        $hora_actual = date('H:i:s');
        $fecha =DateTime::createFromFormat('m/d/Y', $this->fecha)->format('Y-m-d');
        $time = new DateTime($fecha.' '.$hora_actual);
        $int_name=sprintf('PR-%s', $time->format('Ymd-His'));
     
        $query="SELECT id FROM hs_programador WHERE deleted=0 and fecha='{$fecha}'";
    
        $rs=$GLOBALS['db']->query($query);

        if($rs->num_rows>=1){
            $params = array(
                'module'=> 'HS_Programador',
                'action'=>'EditView', 
            // 'id' => $beanID
            );

            SugarApplication::appendErrorMessage('Ya fue ejecutada la programción para la fecha '. $fecha);
            SugarApplication::redirect('index.php?' . http_build_query($params));
        }

        global $current_user;
        $db = DBManagerFactory::getInstance();
        $bol = BeanFactory::getBean('HS_Registro_horas');
        $now = TimeDate::getInstance()->nowDb();
        $excel=array();
        if (isset($_POST['regla'])) {
            $_data = $_POST['regla'];
            array_shift($_data);
            foreach ($_data as $item) {
              
                $aux = $db->insertParams(
                    $bol->getTableName(),
                    $bol->getFieldDefinitions(),
                    array(
                        'id' => create_guid(),
                        'date_entered' => $now,
                        'date_modified' => $now,
                        'name'=>$int_name,
                        'modified_user_id' =>$current_user->id,
                        'created_by' =>$current_user->id,
                        'deleted' => 0,
                        'dia'=> $this->getNameday($this->fecha),
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
                'trabajador'=>$_POST['usuario_name_' . $item], 'movil'=>$_POST['usuario_movil_' . $item], 'direccion'=>$_POST['proyecto_direccion_' . $item]]
                ;

                $excel[]=$temp;
            }
           
            $this->programacion = json_encode($excel);
          //  $this->crearExcel($excel, $fecha);
           
            foreach ($sql_registro_horas as $key => $data) {
                $sql = $sql_inicial[$key] . " " . implode(", ", $data);
                $db->query($sql);
            }
        
           
        }
        $this->name  = $int_name;
    
        return parent::save($check_notify);
    }

    private function getNameday($fecha)
    {
        // Convierte la cadena de fecha en un objeto DateTime
        $fecha_obj = DateTime::createFromFormat("m/d/Y", $fecha);

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


    function crearExcel($data, $fecha){
    
        // Crea una instancia de Spreadsheet
        $spreadsheet = new Spreadsheet();
        
        // Selecciona la hoja activa
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->setTitle($fecha);
        // Agrega datos a la hoja
        $sheet->setCellValue('A1', 'Poyecto');
        $sheet->setCellValue('B1', 'Dirección');
        $sheet->setCellValue('C1', 'Fecha');
        $sheet->setCellValue('D1', 'Hora');
        $sheet->setCellValue('E1', 'Trabajador');
        $sheet->setCellValue('F1', 'Movil');
        
  
       
        $row = 2;
        foreach ($data as $fila) {
            $sheet->setCellValue('A' . $row, $fila['proyecto']);
            $sheet->setCellValue('B' . $row, $fila['direccion']);
            $sheet->setCellValue('C' . $row, $fila['fecha']);
            $sheet->setCellValue('D' . $row, $fila['hora']);
            $sheet->setCellValue('E' . $row, $fila['trabajador']);
            $sheet->setCellValue('F' . $row, $fila['movil']);
            $row++;
        }
        
        // Crea un objeto Writer para guardar el archivo
        $writer = new Xlsx($spreadsheet);
        
        // Guarda el archivo en el servidor o lo descarga
        $nombre_archivo = 'Programación '.$fecha.'.xlsx';
       // $writer->save($nombre_archivo);
        
        // Descarga el archivo Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombre_archivo . '"');
        header('Cache-Control: max-age=3');
        
        $writer->save('php://output');
       // exit();
     
    }
	
}