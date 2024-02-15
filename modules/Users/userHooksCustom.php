<?php




class  UserHooksCustom{


    public function redirigirTrabajador($bean, $event, $arguments){
        global $current_user;
        $rol_id=$this->getUserRoleIdsByUserId($current_user->id);

        if (in_array('c0159c9d-a6a5-0b37-085d-65230ba01145', $rol_id)) {
           SugarApplication::redirect('index.php?module=HS_Registro_horas&action=setregistrohoras');
        } 
   




    }

    public function getUserRoleIdsByUserId($user_id)
    {
        $query = "SELECT 
                         acl_roles.name name_rol,acl_roles.id id_rol
                  FROM 
                        acl_roles 
                 INNER JOIN acl_roles_users 
                         ON acl_roles_users.user_id = '" . $user_id . "' AND 
                            acl_roles_users.role_id = acl_roles.id AND acl_roles_users.deleted = 0 
                 WHERE 
                        acl_roles.deleted=0 ";

        $result = DBManagerFactory::getInstance()->query($query);
        $user_roles = array();

        while ($row = DBManagerFactory::getInstance()->fetchByAssoc($result)) {
            $user_roles[] = $row['id_rol'];
        }

        return $user_roles;
    }





}