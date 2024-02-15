<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class ProjectCustomHooks
{

    public function saveValoresPagar($bean, $event, $arguments)
    {
     
        if (isset($_POST['regla'])) {
            $_valoresPagar = $_POST['regla'];
       
            array_shift($_valoresPagar);

      
            //Declaramos la variable donde guardaremos el campo
            $valoresPagar = array();
            //Recorrer el arreglo de identificadores
            foreach ($_valoresPagar as $item) {
                $aux = array(
                    //Guardar cada uno de los campos con este identificador
                    'puesto' => $_POST['puesto_' . $item],
                    'valor' => $_POST['valor_' . $item],
                    
                );
                //Almacenar la regla
                $valoresPagar[] = $aux;
            }
            $bean->valores_pagar_c = json_encode($valoresPagar);
        }
        $accounttBean=BeanFactory::getBean('Accounts',$bean->account_id_c);
        $accounttBean->load_relationship('project');
        $accounttBean->project->add($bean);

    }

}
