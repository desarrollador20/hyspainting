<?php


class HS_FacturadorController extends SugarController
{



    public function addPago($idFacturador)
    {
        $unike =[];
        
        global $current_user;
        $id = "'" . str_replace(",", "','", $idFacturador) . "'";
        $idFacturador;
        $query = "SELECT id, desde, hasta, user_id_c FROM hs_facturador WHERE id IN( {$id}) and pagado <> 'Si'";
  
        $rs = $GLOBALS['db']->query($query);
        // Variables para construir la condición CASE WHEN
        $caseConditions = [];
        while ($row = $GLOBALS['db']->fetchByAssoc($rs)) {
            // Construir condiciones para cada fila
            $condition = "WHEN user_id_c = '{$row['user_id_c']}' AND fecha BETWEEN '{$row['desde']}' AND '{$row['hasta']}' THEN 'Pagado'";
            $caseConditions[] = $condition;
            $unike[]=$row['id'];
        }
        // Unir todas las condiciones con CASE WHEN en una cadena
        if( count($unike)>=1){
        $caseExpression = implode(" ", $caseConditions);
        // Construir y ejecutar la actualización final
        $sql = "UPDATE hs_prestamos SET estado =  CASE  {$caseExpression}  ELSE estado  END  WHERE deleted = 0";
        $GLOBALS['db']->query($sql);
        //auditoria  prestamos 

        $sql = "UPDATE hs_facturador SET pagado= 'Si' ,date_modified =now(), modified_user_id ='$current_user->id' where id in ({$id})";
        $GLOBALS['db']->query($sql);
        $this->addAuditoria($unike);
        }
        return 'true';
    }

    private function addAuditoria($ids)
    {
      
        $datos = [];

        global $current_user;
        $sql = "INSERT INTO hs_facturador_audit";
        $values = array(
            'id' => '0',
            'parent_id' => '0',
            'field_name' => '',
            'data_type' => 'varchar',
            'before_value_string' => '',
            'after_value_string' => '',
            'date_created' => TimeDate::getInstance()->nowDb(),
            'created_by' => $current_user->id
        );
        $sql .= "(" . implode(",", array_keys($values)) . ") VALUES";

        foreach ($ids as $unik) {
            $values['id'] = create_guid();
            $values['parent_id'] = $unik;
            $values['field_name'] = 'pagado';
            $values['before_value_string'] = 'No';
            $values['after_value_string'] = 'Si';
            $datos[] = "('" . implode("','", $values) . "')";
        }

        $sql .= implode(", ", $datos);
  
        $GLOBALS['db']->query($sql);
    }
}
