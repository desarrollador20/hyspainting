<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class HS_inventariosHooks
{

    public function addBottonList($bean, $event, $arguments)
    {
     
        // Verificar alguna condición en tu bean
        if ($bean->prestado=='No') {
            // Utilizar el icono con función onclick
            $icon = '<span class="icon-green"><i class="fas fa-check fa-2x" style="color: green;" onclick="dialogo_enviar_qsms( \'' . $bean->id . '\',\'' . $bean->prestado . '\',0,' . $bean->cantidades_inventario . ')"title="Prestar"></i></span>';
        }else if ($bean->prestado=='Si') {
            // Utilizar el icono con función onclick
            $icon .= '<span class="icon-red"><i class="fas fa-times fa-2x" style="color: red;" onclick="dialogo_enviar_qsms(\'' . $bean->id . '\',\'' . $bean->prestado . '\',1,' . $bean->cantidades_prestadas . ',\'' . $bean->fecha_prestamo . '\')" title="Devolver"></i></span>';
        }else {
            // Utilizar el icono con función onclick
              $icon = '<span class="icon-green"><i class="fas fa-check fa-2x" style="color: green;" onclick="dialogo_enviar_qsms( \'' . $bean->id . '\',\'' . $bean->prestado . '\',0,' . $bean->cantidades_inventario . ')"title="Prestar"></i></span>';
              $icon .= '<span class="icon-red"><i class="fas fa-times fa-2x" style="color: red;" onclick="dialogo_enviar_qsms(\'' . $bean->id . '\',\'' . $bean->prestado . '\',1,' . $bean->cantidades_prestadas . ',\'' . $bean->fecha_prestamo . '\')" title="Devolver"></i></span>';
        }
        $bean->prestado = $icon;
    }


}
