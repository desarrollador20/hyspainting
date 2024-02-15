<?php



if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


class HS_inventariosController extends SugarController
{
    public function getUser()
    {
        $query = "SELECT id, user_name FROM users WHERE status = 'Active' AND deleted = 0";
        $rs = $GLOBALS['db']->query($query);

        $data = array();

        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            $data[] = [
                'id' => $row['id'],
                'user_name' => $row['user_name']
            ];
        }
        return $data;
    }

    public function getListas()
    {

        global  $app_list_strings;
        $estado_inventario = $app_list_strings['hs_inventario_estado'];
        return $estado_inventario;
    }


    function savePrestamo($data)
    {
        $dateString = $data['fecha'];
        $dateTime = DateTime::createFromFormat('Y/m/d H:i', $dateString);
        $dateTime->add(new DateInterval('PT5H'));
        $formattedDate = $dateTime->format('Y-m-d H:i:s');


        $prestamo = BeanFactory::getBean('HS_inventarios', $data['id']);
        $prestado = $data['usuario'] == 'null' ? 'No' : 'Si';
        $usuario = $data['usuario'] == 'null' ? '' : $data['usuario'];
        $prestamo->prestado_name = '';
        if ($usuario != '') {
            $user = BeanFactory::getBean('Users', $usuario);
            $prestamo->prestado_name = $user->user_name;
            $prestamo->fecha_prestamo = $formattedDate;
        } else {
            $prestamo->fecha_devolucion = $formattedDate;
            $prestamo->fecha_prestamo = '';
        }



        $prestamo->estado = $data['estado'];
        $prestamo->user_id_c = $usuario;
        $prestamo->prestado = $prestado;

        $prestamo->save();
    }


    function getSerial($serial)
    {
        $valor = 'false';
        $inventario = BeanFactory::getBean('HS_inventarios');
        $data = $inventario->retrieve_by_string_fields(
            array(
                'num_serie' => $serial,
            )
        );
        if (isset($data->id)) {
            $valor = 'true';
        }
        return $valor;
    }
}
