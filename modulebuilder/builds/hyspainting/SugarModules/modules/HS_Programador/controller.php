<?php

require 'modules/HS_Programador/excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HS_programadorController extends SugarController
{


    public function getUser($id_proyecto)
    {

        $proyecto = BeanFactory::getBean('Project', $id_proyecto);

        // Obtener los usuarios vinculados al proyecto
        $usuariosVinculados = $proyecto->get_linked_beans('project_users_1');

        // Obtener todos los usuarios activos disponibles en la base de datos
        $allUsers = BeanFactory::getBean('Users')->get_full_list("status = 'Active'");

        // Crear un array para almacenar los IDs de los usuarios vinculados al proyecto
        $linkedUserIds = [];
        foreach ($usuariosVinculados as $usuario) {
            $linkedUserIds[] = $usuario->id;
        }

        $usuariosVinculadosArray = [];
        $usuariosNoVinculadosArray = [];

        foreach ($allUsers as $user) {
            $array = array();
            $array['id'] = $user->id;
            $array['name'] = $user->user_name;
            $array['puesto'] = $user->department;

            // Verificar si el usuario está vinculado al proyecto y agregarlo al array correspondiente
            if (in_array($user->id, $linkedUserIds)) {
                $usuariosVinculadosArray[] = $array;
            } else {
                $usuariosNoVinculadosArray[] = $array;
            }
        }

        $results = [
            'vinculados' => $usuariosVinculadosArray,
            'no_vinculados' => $usuariosNoVinculadosArray
        ];

        return $results;
    }

    public function verificarFechaProgramacion($fecha)
    {
        $fecha_obj = DateTime::createFromFormat('m/d/Y', $fecha)->format('Y-m-d');
        $query = "select id from hs_programador where fecha='{$fecha_obj}'";
        $rs = $GLOBALS['db']->query($query);
        $row = $GLOBALS['db']->fetchByAssoc($rs);
        if ($row) {
            return 'existe';
        } else {
            return  'no existe';
        }
    }


    public function obtenerUsuarios($data)
    {
        $cargos = $GLOBALS['app_list_strings']['hs_valores_pagar'];
        $userData = [];
        $datos = implode(',', array_map(function ($id) {
            return "'" . $id . "'";
        }, $data));


        $query = "SELECT users.id as id, users.first_name as first_name, users.last_name as last_name , users.user_name as user_name, users.phone_mobile  as phone_mobile, users_cstm.puesto_c as department from users 
        LEFT JOIN users_cstm on users.id=users_cstm.id_c
        where users.deleted=0 and users.status='Active' ";
        if (!empty($data)) {
            $query .= " AND users.id NOT IN ($datos)";
        }

        $rs = $GLOBALS['db']->query($query);


        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {


            $userData[] = array(
                "id" => $row['id'],
                "name" => $row['first_name'] . ' ' . $row['last_name'],
                "user" => $row['user_name'],
                "movil" => $row['phone_mobile'],
                "department" => $cargos[$row['department']]
            );
        }
        return $userData;
    }


    function obtenerProyecto($id)
    {

        $proyecto = BeanFactory::getBean('Project', $id);

        $data = [$proyecto->name, $proyecto->hora_entrada_c, $proyecto->jjwg_maps_address_c];

        return $data;
    }


    function addExcel($id)
    {


        $programacion = BeanFactory::getBean('HS_Programador', $id);
        $fecha = date('Y-m-d', strtotime($programacion->fecha));
        $data = json_decode(html_entity_decode($programacion->programacion), true);

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
            $hora=explode(' ',$fila['hora']);
            $sheet->setCellValue('A' . $row, $fila['proyecto']);
            $sheet->setCellValue('B' . $row, $fila['direccion']);
            $sheet->setCellValue('C' . $row, $fila['fecha']);
            $sheet->setCellValue('D' . $row, $hora[1]);
            $sheet->setCellValue('E' . $row, $fila['trabajador']);
            $sheet->setCellValue('F' . $row, $fila['movil']);
            $row++;
        }

        // Crea un objeto Writer para guardar el archivo
        $writer = new Xlsx($spreadsheet);

        // Guarda el archivo en el servidor o lo descarga
        $nombre_archivo = 'Programación ' . $fecha . '.xlsx';
        //  $writer->save($nombre_archivo);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombre_archivo . '"');
        header('Cache-Control: max-age=3');

        $writer->save('php://output');
        exit();
    }


    protected function post_save()
    {

        //  $this->view='edit';
        SugarApplication::redirect('index.php?module=HS_Programador&action=index&parentTab=Todo');
    }


    public function action_delete()
    {
        $llave=$this->bean->name;
        $query="UPDATE hs_registro_horas set deleted=1 where name='$llave'";
        $GLOBALS['db']->query($query);
        return parent::action_delete();
    }
}
