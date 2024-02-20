<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'modules/Users/controller.php';
require_once 'custom/modules/Users/userHooksCustom.php';


class CustomUsersController extends UsersController
{

    protected function post_save()
    {
        $module = (!empty($this->return_module) ? $this->return_module : $this->module);
        $action = (!empty($this->return_action) ? $this->return_action : 'DetailView');
        $id = (!empty($this->return_id) ? $this->return_id : $this->bean->id);
       
        $constrolleruserHooksCustom = (new UserHooksCustom())->getUserRoleIdsByUserId($this->bean->id);
       
        if(!$this->bean->is_admin && $constrolleruserHooksCustom[0] === NULL) {
            // ID del rol al que deseas agregar al usuario
            $role_id_trabajador = 'c0159c9d-a6a5-0b37-085d-65230ba01145';
            // Obtener el bean del rol
            $role = BeanFactory::getBean('ACLRoles', $role_id);

            // Verificar si el rol existe y si el usuario no está ya asignado a ese rol
            if (!empty($role)) {
                $GLOBALS['db']->query("INSERT INTO acl_roles_users (id,role_id,date_modified, user_id) VALUES (UUID(),'$role_id_trabajador',NOW(),'{$this->bean->id}')");
            }
        }
      
       
        $url = "index.php?module=" . $module . "&action=" . $action . "&record=" . $id;
        $this->set_redirect($url);
    }
}