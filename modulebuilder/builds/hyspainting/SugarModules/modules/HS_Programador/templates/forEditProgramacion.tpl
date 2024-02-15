<script type="text/javascript" src="modules/HS_Programador/templates/scripts/reglas.js?v=3"></script>
<script type="text/javascript" src="modules/HS_Programador/javascript/select2/select2.min.js"></script>
<script>
    // Declarar los datos para el QuickSearch para la búsqueda de un establecimiento
</script>

{literal}
<style>
    /* Estilo para la tabla */
    table.lista {
        width: 100%;
        border-collapse: collapse;
    }

    table.lista th,
    table.lista td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    table.lista th {
        background-color: #f2f2f2;
    }

    /* Estilo para el proyecto */
    tr.project td {
        text-align: left;
        font-weight: bold;
        background-color: #e0e0e0;
    }

    /* Estilo para la fila de usuarios */
    tr.user td {
        text-align: center;
    }

    /* Estilo para los botones */
    button {
        background-color: #F08377;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    button:hover {
        background-color: #F08377;
    }

    /* Estilo para la fila "Total de usuarios" */
    tr.total td {
        text-align: right;
        font-weight: bold;
        background-color: #e0e0e0;

    }

    td.total button {
        margin-left: 10px;
    }

    .proy {
        text-align: center !important;
    }

    .trspacer td {
        height: 20px;
    }

    .ui-dialog {
        z-index: 1;
    }
    .celula-especial:hover {
      background-color: #f0f0f0;
     cursor: pointer;
    }

</style>
{/literal}

<link rel="stylesheet" type="text/css" href="modules/HS_Programador/templates/styles/reglas.css?v=2" />
<link rel="stylesheet" type="text/css" href="modules/HS_Programador/javascript/select2/select2.min.css" />

<table class='lista'>
    <tbody>
        <tr class='cabecera'>

            <th>Usuario</th>
            <th>Rol</th>
            <th>Eliminar</th>
        </tr>

        <tr class='user' id="clone">
            <input type='hidden' name='regla[]' value='%rand%'>
            <input type='hidden' name='usuario_id_%rand%' id='usuario_id_%rand%' value='' class='wm'>
            <input type='hidden' name='proyecto_id_%rand%' id='proyecto_id_%rand%' value='' class='wm'>
            <input type='hidden' name='proyecto_name_%rand%' id='proyecto_name_%rand%' value='' class='wm'>
            <input type='hidden' name='proyecto_entrada_%rand%' id='proyecto_entrada_%rand%' value='' class='wm'>
            <input type='hidden' name='usuario_name_%rand%' id='usuario_name_%rand%' value='' class='wm'>
            <input type='hidden' name='usuario_movil_%rand%' id='usuario_movil_%rand%' value='' class='wm'>
            <input type='hidden' name='proyecto_direccion_%rand%' id='proyecto_direccion_%rand%' value='' class='wm'>
            <td>
                {$usuario.name}
            </td>
            <td>
                {$usuario.department}
            </td>
            <td>
                <button type="button" onclick="removeReglaItem(this);">{sugar_getimage name="id-ff-remove-nobg"
                    alt="$app_strings.LBL_ID_FF_REMOVE" ext=".png"}</button>
                <script type="text/javascript">
                    setEvents('{$rand}');
                </script>
            </td>
        </tr>
        {foreach from=$proyectos item=proyecto}
        {assign var="totalUsuarios" value=0}
        <tr class='project'>
            <td class="proy" colspan="3">
                {$proyecto.nombre_proyecto}
            </td>
        </tr>
        {foreach from=$proyecto.usuarios item=usuario}{assign var=rand value=100000|mt_rand:999999}
        <tr class='user'>
            <input type='hidden' name='regla[]' value='{$rand}'>
            <input type='hidden' name='usuario_id_{$rand}' id='usuario_id_{$rand}' value='{$usuario.id}' class='wm'>
            <input type='hidden' name='proyecto_id_{$rand}' id='proyecto_id_{$rand}' value='{$proyecto.id_proyecto}'
                class='wm'>

            <input type='hidden' name='proyecto_name_{$rand}' id='proyecto_name_{$rand}'
                value='{$proyecto.nombre_proyecto}' class='wm'>
            <input type='hidden' name='proyecto_entrada_{$rand}' id='proyecto_entrada_{$rand}' value='{$proyecto.hora}'
                class='wm'>

            <input type='hidden' name='usuario_name_{$rand}' id='usuario_name_{$rand}' value='{$usuario.name}'
                class='wm'>
            <input type='hidden' name='usuario_movil_{$rand}' id='usuario_movil_{$rand}' value='{$usuario.phone_mobile}'
                class='wm'>
            <input type='hidden' name='proyecto_direccion_{$rand}' id='proyecto_direccion_{$rand}'
                value='{$proyecto.direccion}' class='wm'>

            <td class="celula-especial" onclick="dialogo_user('{$usuario.id}', '{$usuario.user_name}');">
                {$usuario.name}
            </td>
            <td>
                {$usuario.department}
            </td>
            <td>
                <button type="button" onclick="removeReglaItem(this);">{sugar_getimage name="id-ff-remove-nobg"
                    alt="$app_strings.LBL_ID_FF_REMOVE" ext=".png"}</button>
                <script type="text/javascript">
                    setEvents('{$rand}');
                </script>
            </td>
        </tr>
        {assign var="totalUsuarios" value=$totalUsuarios+1}
        {/foreach}
        <!-- Fila "Total de usuarios" -->
        <tr class='total' id='{$proyecto.id_proyecto}'>
            <td colspan="4">
                <span>Total de usuarios: {$totalUsuarios} </span>
                <button class="addUserButton" onclick="getUser('{$proyecto.id_proyecto}');" type="button">Agregar
                    usuarios</button>
            </td>
        </tr>
        <tr class="trspacer">
            <td colspan="4"></td>
        </tr>
        {/foreach}
    </tbody>
</table>


{literal}
<script>

    function countUser(id) {
        const proyectoActual = id; // Reemplaza esto con el ID real del proyecto.
        // Obtén todas las filas de usuario en la tabla.
        const filasUsuarios = document.querySelectorAll('.user');
        // Encuentra las filas que pertenecen al mismo proyecto.
        const filasMismoProyecto = Array.from(filasUsuarios).filter((fila) => {
            const proyectoID = fila.querySelector('input[name^="proyecto_id_"]').value;
            return proyectoID === proyectoActual;
        });
        // Filtra las filas para excluir la fila actual (opcional).
        const hermanos = filasMismoProyecto.filter((fila) => {
            // Reemplaza 'usuario_id_actual' con el ID real de la fila actual.
            const usuarioIDActual = 'usuario_id_actual';
            return fila.querySelector('input[name^="usuario_id_"]').value !== usuarioIDActual;
        });

        usuarios = [];
        for (let i = 0; i < hermanos.length; i++) {
            const fila = hermanos[i];
            const usuarioID = fila.querySelector('input[name^="usuario_id_"]').value;
            usuarios.push(usuarioID);
        }

        return usuarios;
    }


    function searchNameProyect(id) {
        let hermanoAnterior = document.getElementById(id).previousElementSibling;
  
        if (hermanoAnterior.querySelector('input[name^="proyecto_name_"]')) {
            // Si tienes un <input> específico dentro del hermano anterior, puedes seleccionarlo así
            let name = hermanoAnterior.querySelector('input[name^="proyecto_name_"]').value;
            let hora = hermanoAnterior.querySelector('input[name^="proyecto_entrada_"]').value;
            let direccion = hermanoAnterior.querySelector('input[name^="proyecto_direccion_"]').value;
            // Verifica si se encontró el <input>
            if (name) {
                 data = [name, hora, direccion];
                return data; 
            }
        } else {
            console.log(getProyect(id));
            return getProyect(id);
       
      
        
        }

       

    }

    function addUser(usuario, proyecto) {

        // Puedes omitir esta llamada si no es necesaria
        const rand = Math.ceil(Math.random() * 899999 + 100000);

        // Clona la fila de usuario existente
        const originalRow = document.getElementById('clone');
        const newRow = originalRow.cloneNode(true);
        newRow.removeAttribute('id')
        let info = searchNameProyect(proyecto);
        // Modifica los valores de los campos ocultos
        newRow.querySelector(`input[name='regla[]']`).value = rand;
        newRow.querySelector(`input[name='usuario_id_%rand%']`).value = usuario.userId;
        newRow.querySelector(`input[name='proyecto_id_%rand%']`).value = proyecto;
        newRow.querySelector(`input[name='proyecto_name_%rand%']`).value = info[0];
        newRow.querySelector(`input[name='proyecto_entrada_%rand%']`).value = info[1];
        newRow.querySelector(`input[name='usuario_name_%rand%']`).value = usuario.userName;
        newRow.querySelector(`input[name='usuario_movil_%rand%']`).value = usuario.phone_mobile;
        newRow.querySelector(`input[name='proyecto_direccion_%rand%']`).value = info[2];


        // Reemplaza %rand% en el contenido visible de la fila
        const contenidoFila = newRow.innerHTML;
        const contenidoModificado = contenidoFila.replace(/%rand%/g, rand);
        newRow.innerHTML = contenidoModificado;

        const lastTds = newRow.querySelectorAll('td:nth-last-child(-n+3)');
        lastTds[0].textContent = usuario.userName; // Agrega el valor del departamento
        lastTds[1].textContent = usuario.userDepartment; // Agrega otro valor a la última <td>

        const firstTd = newRow.querySelector('td');
        firstTd.addEventListener('click', function () {
            // Tu código de evento aquí
            // Por ejemplo, puedes usar 'usuario.id' o 'usuario.name' en el evento
            dialogo_user(usuario.userId, usuario.userName);
        });
        // Agrega la nueva fila a la tabla antes de la fila identificada por "proyecto"
        const originalContainer = document.getElementById(proyecto);
        originalContainer.parentNode.insertBefore(newRow, originalContainer);
        contador(proyecto);

    }


    function getUser(id) {
        usuarios = countUser(id);
        const query = {
            action: 'ObtenerUsuarios',
            usuarios: usuarios
        }
        console.log(usuarios);

        $.ajax({
            type: "POST",
            url: 'index.php?entryPoint=GetMethodsProgramadorEntryPoint',
            data: query,
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, jqXHR, errorThrown)
            },
            success: function (data) {
                const results = data;
                if (results == null) {
                    alert("Fallo el servicio. ¡Por favor intenta de nuevo!");
                    return;
                }
                if (results?.length === 0) {
                    alert("El proyecto ya tiene todos los trabajadores asignados");

                    return;
                }

                //  drawPrerequisitos(results);
                console.log(results);
                openModal(id, results);
            }
        });

    }


    function getProyect(id) {
        const query = {
            action: 'obtenerProyecto',
            proyecto: id
        }
      

        $.ajax({
            type: "POST",
            url: 'index.php?entryPoint=GetMethodsProgramadorEntryPoint',
            data: query,
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, jqXHR, errorThrown)
            },
            success: function (data) {
                const results = data;
                if (results == null) {
                    alert("Fallo el servicio. ¡Por favor intenta de nuevo!");
                    return;
                }
                if (results?.length === 0) {
                    alert("El proyecto ya tiene todos los trabajadores asignados");

                    return;
                }
                console.log(results);

                //  drawPrerequisitos(results);
               return results;
            }
        });

    }






    function openModal(proyecto, usuarios) {
        var fechaLabel = 'Fecha de devolución: ...';

        var fechaLabel = 'Fecha de prestamo: ...';

        var modalElement = $("<div><div id='users' style='z-index: 10000;'> <p><label>Seleccione el usuario</label><select class='js-example-basic-single' name='plantilla' id='plantilla' style='width: 100%;'>  </select>  </p> </div>").dialog({

            title: "Programación trabajadores",
            width: 363,
            close: function () {
                console.log("Modal cerrado");
                $(this).dialog("destroy"); // Destruir el modal cuando se cierra
            },
            clickOutside: true,
            buttons: {
                Agregar: function () {

                    var selectedUserId = $('#plantilla').val();

                    // Busca el usuario correspondiente en el array de usuarios
                    var selectedUser = usuarios.find(function (usuario) {
                        return usuario.id === selectedUserId;
                    });

                    // Verifica si se encontró el usuario
                    if (selectedUser) {
                        // Combina el valor seleccionado y la información del usuario en un objeto
                        var userData = {
                            userId: selectedUserId,
                            userName: selectedUser.name,
                            userDepartment: selectedUser.department,
                            userPhone_mobile: selectedUser.phone_mobile,
                            // Agrega más propiedades según la estructura de tu objeto de usuario
                        };

                        // Realiza la acción deseada con la información combinada

                        addUser(userData, proyecto);
                        var select2 = $('.js-example-basic-single').select2();

                        var optionToRemove = select2.find('option[value="' + selectedUserId + '"]');

                        // Verifica si se encontró el elemento
                        if (optionToRemove.length) {
                            // Utiliza el método .remove() para eliminar el elemento option
                            optionToRemove.remove();

                            // Luego, debes actualizar Select2 para reflejar el cambio
                            select2.trigger('change');
                        }
                        // Si deseas enviar esta información a través de una solicitud AJAX
                        // Puedes hacerlo aquí
                    }
                },
            },

            create: function () {

                var select2 = $('.js-example-basic-single').select2();
                // Agrega un nuevo elemento

                usuarios.forEach(function (usuario) {
                    var option = new Option(usuario.name, usuario.id);
                    select2.append(option);
                });

                // Actualiza el selector Select2 después de agregar opciones
                select2.trigger('change');

                $(this).find('.plantilla').on('change', function () {
                    if ($(this).val() != '') {
                        $('.qsms_mensaje').prop('disabled', true);
                        $('.qsms_mensaje').val('');

                    } else {
                        $('.qsms_mensaje').prop('disabled', false);

                    }

                });

            }


        }); //end confirm dialog
    }


</script>

{/literal}