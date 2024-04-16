<?php


function getValoresPagarWidget($focus, $field, $value, $view, $tabindex = '0')
{
    global $mod_strings, $app_strings, $app_list_strings;
    $cargos = $GLOBALS['app_list_strings']['hs_valores_pagar'];
    $numeroElementos = count($cargos);
    //Declarar JSON y Smarty
    $json = new JSON();
    $ss = new Sugar_Smarty();
    $ss->assign('prioridad', false);

    $template = "custom/modules/Project/templates/forDetailValores.tpl";

    //Decodificar la variable (está almacenada como JSON)
    //Asignar elementos de traducción
    $ss->assign('MOD', $mod_strings);
    $ss->assign('cargos', $cargos);
    $ss->assign('long_list', $numeroElementos);






    if (isset($focus->valores_pagar_c) && !empty($focus->valores_pagar_c)) {
        $aux = $json->decode(html_entity_decode($focus->valores_pagar_c));
    } else {
        $aux = [];
    }



    $ss->assign('reglas', $aux);

    //Datos de plaza, nivel, grupos y categorías

    //Si es edición, usar la plantilla de edición
    if ($view == 'EditView' || $view == 'QuickCreate') {
        //Declaramos QuickSearch si hay un campo que lo requiere
        $template = "custom/modules/Project/templates/forEditValores.tpl";
    }


    //Retornar el resultado de la plantilla
    return $ss->fetch($template);
}


function getProgramacionWidget($focus, $field, $value, $view, $tabindex = '0')
{
    global $mod_strings, $app_strings, $app_list_strings;
    $cargos = $GLOBALS['app_list_strings']['hs_valores_pagar'];
    $projectsData = array();

    // Obtén todos los proyectos activos en una sola consulta
    $query = "SELECT project.id as id, project.name as name, CONVERT_TZ( project_cstm.hora_entrada_c, '+00:00', '-04:00') as entrada, project_cstm.jjwg_maps_address_c as direccion FROM project LEFT JOIN project_cstm on 
    project.id=project_cstm.id_c   WHERE project.deleted=0 AND project.status='activo'";;

    $rs = $GLOBALS['db']->query($query);

    // Obtén todos los usuarios activos disponibles en una sola consulta
    $allUsers = BeanFactory::getBean('Users')->get_full_list("status = 'Active'");
    $allUsersMap = [];

    foreach ($allUsers as $user) {
        $allUsersMap[$user->id] = array(
            "id" => $user->id,
            "name" => $user->first_name . ' ' . $user->last_name,
            "user_name" => $user->user_name,
            "department" => $cargos[$user->puesto_c],
            "phone_mobile"=>$user->phone_mobile,
        );
    }

    while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
        $projectID = $row['id'];
        $userResults = getUser($projectID, $allUsersMap);

        $projectsData[] = array(
            "nombre_proyecto" => $row['name'],
            "id_proyecto" => $row['id'],
            "hora"=>$row['entrada'],
            "direccion"=>$row['direccion'],
            "usuarios" => $userResults
        );
    }


    $json = new JSON();
    $ss = new Sugar_Smarty();
    $template = "modules/HS_Programador/templates/forEditProgramacion.tpl";

    $ss->assign('proyectos', $projectsData);
    return $ss->fetch($template);
}

function getUser($proyect_id, $allUsersMap)
{
    $proyecto = BeanFactory::getBean('Project', $proyect_id);
    $usuariosVinculados = $proyecto->get_linked_beans('project_users_1');

    $usuariosVinculadosArray = [];

    foreach ($usuariosVinculados as $usuario) {
        $userID = $usuario->id;
        if (isset($allUsersMap[$userID])) {
            $usuariosVinculadosArray[] = array(
                "id" => $allUsersMap[$userID]["id"],
                "name" => $allUsersMap[$userID]["name"],
                "user_name" => $allUsersMap[$userID]["user_name"],
                "department" => $allUsersMap[$userID]["department"],
                "phone_mobile" => $allUsersMap[$userID]["phone_mobile"]
            );
        }
    }

    return $usuariosVinculadosArray;
}