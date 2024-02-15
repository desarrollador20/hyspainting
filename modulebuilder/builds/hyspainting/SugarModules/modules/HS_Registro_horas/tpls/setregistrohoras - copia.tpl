<link rel="stylesheet" type="text/css" href="modules/HS_Registro_horas/tpls/styles/view.edit.css" />
<title>Registro de Horas Semanales</title>
<div class="container">
  <h2 id="titulo-registro">Registro de Horas Semanales</h2>

  <form action="index.php" method="POST" name="EditView" id="EditView" enctype="multipart/form-data">
    <table>
      <tr>
        <th colspan="5"><label class="project-label">Semana</label>
          <select id='semanas-select'>
            {foreach from=$semanas item=option}
            <option value="{$option.value}">{$option.label}</option>
            {/foreach}
          </select>
        </th>
      </tr>
      <!-- Repetir el siguiente bloque para cada día de la semana -->
      <tr>
        <td colspan="4">

          <div class="day-container" id="day-container-1">
            <h4 style="margin-left: 0;" class='dia'><span>Lunes</span> <button type="button" class="add-button">{sugar_getimage name="id-ff-add"
                alt="$app_strings.LBL_ID_FF_ADD"
                ext=".png"}</button></h4>
            <span name='span' id='%rand%'>
              <div class="select-container" name=''>
                <input type="hidden" name="registro_id_%rand%">
                <input type='hidden' name='regla[]' value='%rand%'>
                <input type='hidden' name='fecha_%rand%' value=''>
                <input type='hidden' name='dia_%rand%' value=''>
                <label class="project-label">Proyecto</label>
                {html_options name='project_%rand%' options=$projects }
              </div>
              <div class="hours-row">
                <div class="hours-label">Horas trabajadas:</div>
                <div class="hours-label">Horas viaje:</div>
              </div>
              <div class="hours-row">
                <input class="hours-input" name='horas_trabajo_%rand%' type="number" step="0.1" value="0.0">
                <input class="hours-input" type="number" name='horas_viaje_%rand%' step="0.1" value="0.0">
              </div>
            </span>
          </div>

        </td>
      </tr>
    </table>
    <div class="buttons">
      <input type="hidden" name="module" value="HS_Registro_horas">
      <input type="hidden" name="action" value="saveregistrohoras">
      <input id="btnnextb" class="button" type="button" name="button" value="Registrar >>" onclick="siguiente()">
      <input id="btncancelb" class="button" type="button" name="button" value="Limpiar >>" onclick="cancelar()">
    </div>
  </form>
</div>

{literal}
<script>
  let dayCount = 1; // Lleva la cuenta de los contenedores de día
  var valores = [];
  document.addEventListener('DOMContentLoaded', function() {
  getOption();
    $("#semanas-select").off("change").on("change", function(e) {
      eliminarContenedores();
      getRegistros($(this).val());
    });
  });

  function getOption(){
  var selectElement = document.getElementById("semanas-select");
  var primerValorSeleccionado = selectElement.options[selectElement.selectedIndex].value;
  getRegistros(primerValorSeleccionado);
  }

  function addDayContainer(data, contenedor) {
    dayCount++;
    const originalContainer = document.getElementById(`day-container-${dayCount - 1}`);
    const clonedContainer = originalContainer.cloneNode(true);
    // Cambia el id del nuevo contenedor clonado
    const newContainerId = `day-container-${dayCount}`;
    clonedContainer.setAttribute('id', newContainerId);
    // Cambia los atributos 'name' de los campos de entrada en el nuevo contenedor
    const rand = Math.ceil(Math.random() * 899999 + 100000);
    const horasTrabajoInput = clonedContainer.querySelector('input[name^="horas_trabajo_"]');
    const horasViajeInput = clonedContainer.querySelector('input[name^="horas_viaje_"]');
    const selectProyecto = clonedContainer.querySelector('select[name^="project_"]');
    const registroId = clonedContainer.querySelector('input[name^="registro_id_"]');
    const regla = clonedContainer.querySelector('input[name^="regla"]');
    const span = clonedContainer.querySelector('span[name^="span"]');

    const fecha = clonedContainer.querySelector('input[name^="fecha_"]');
    const dia = clonedContainer.querySelector('input[name^="dia_"]');

    span.setAttribute('id', rand);

    horasTrabajoInput.setAttribute('name', `horas_trabajo_${rand}`);
    horasViajeInput.setAttribute('name', `horas_viaje_${rand}`);
    selectProyecto.setAttribute('name', `project_${rand}`);
    registroId.setAttribute('name', `registro_id_${rand}`);

    fecha.setAttribute('name', `fecha_${rand}`);
    dia.setAttribute('name', `dia_${rand}`);
    regla.value = rand;
    selectProyecto.disabled = true;
    // Asigna valores a los campos del nuevo contenedor
    //const selectProyecto = clonedContainer.querySelector('select[name="proyecto"]');
    const dateParts = data.fecha.split('-'); // Divide la fecha en partes (año, mes, día)
    const formattedFecha = `${dateParts[2]}-${getMonthName(dateParts[1])}-${dateParts[0]}`; // Formato "dia-mes-año"

    selectProyecto.value = data.project_id_c;
    registroId.value = data.id;
    dia.value = data.dia;
    fecha.value = data.fecha;

    horasViajeInput.value = data.horas_viaje;
    horasTrabajoInput.value = data.horas_trabajo;
    const labelDia = clonedContainer.querySelector('.dia');
    const spanElement = labelDia.querySelector('span'); // Obtén el elemento <span> dentro de .dia
    spanElement.textContent = data.dia + ' ' + formattedFecha;

    const addButton = clonedContainer.querySelector('.add-button');
    addButton.addEventListener('click', function() {
      addDayContainer2(false, newContainerId);
    });

    if (data.id == 0) {
      valores.push(rand);
      selectProyecto.disabled=false; 
    }

    // Inserta el contenedor clonado debajo del original
    originalContainer.parentNode.insertBefore(clonedContainer, originalContainer.nextSibling);


  }


  function addDayContainer2(data, contenedor) {
    var dayContainer = document.getElementById(contenedor);
    var inputElement = dayContainer.querySelector('span[name="span"]');
    if (inputElement.classList == 'ocultar-span') {
      inputElement.classList.remove('ocultar-span');
      return;
    }

    dayCount++;
    const originalContainer = document.getElementById(contenedor);
    const clonedContainer = originalContainer.cloneNode(true);
    // Cambia el id del nuevo contenedor clonado
    const newContainerId = `day-container-${dayCount}`;
    clonedContainer.setAttribute('id', newContainerId);
    // Cambia los atributos 'name' de los campos de entrada en el nuevo contenedor
    const rand = Math.ceil(Math.random() * 899999 + 100000);
    const horasTrabajoInput = clonedContainer.querySelector('input[name^="horas_trabajo_"]');
    const horasViajeInput = clonedContainer.querySelector('input[name^="horas_viaje_"]');
    const selectProyecto = clonedContainer.querySelector('select[name^="project_"]');
    const regla = clonedContainer.querySelector('input[name^="regla"]');
    const registroId = clonedContainer.querySelector('input[name^="registro_id_"]');
    const fecha = clonedContainer.querySelector('input[name^="fecha_"]');
    const dia = clonedContainer.querySelector('input[name^="dia_"]');
    const span = clonedContainer.querySelector('span[name^="span"]');

    horasTrabajoInput.setAttribute('name', `horas_trabajo_${rand}`);
    horasViajeInput.setAttribute('name', `horas_viaje_${rand}`);
    selectProyecto.setAttribute('name', `project_${rand}`);
    registroId.setAttribute('name', `registro_id_${rand}`);
    fecha.setAttribute('name', `fecha_${rand}`);
    dia.setAttribute('name', `dia_${rand}`);
    span.setAttribute('id', `span-${rand}`)
    selectProyecto.disabled = false;
    regla.value = rand;
    registroId.value = 0;
    horasTrabajoInput.value='';
    horasViajeInput.value='';


    // Asigna valores a los campos del nuevo contenedor
    //const selectProyecto = clonedContainer.querySelector('select[name="proyecto"]');
    const addButton = clonedContainer.querySelector('.add-button');
    addButton.addEventListener('click', function() {
      addDayContainer2(false, newContainerId);
    });

    // Inserta el contenedor clonado debajo del original
    originalContainer.parentNode.insertBefore(clonedContainer, originalContainer.nextSibling);
  }

  function getRegistros(fechas) {
    const query = {
      action: 'getRegistros',
      fechas: fechas
    };

    $.ajax({
      type: "POST",
      url: 'index.php?entryPoint=GetMethodsRegistroEntryPoint',
      data: query,
      dataType: "json",
      success: function(data) {
        console.log(data) // Resuelve con los datos obtenidos de la llamada AJAX
        drawRegistroHoras(data);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error(textStatus, jqXHR, errorThrown);

      }
    });
  }

  function siguiente() {
    if (true) {
      document.getElementById('EditView').submit();
    }
  }

  function cancelar() {
    eliminarContenedores();
  }

  function drawRegistroHoras(data) {
    valores.length = 0
    for (const property in data) {
      addDayContainer(data[property]);
    }
    verContenido()

  }

  function getMonthName(monthNumber) {
    const months = [
      "enero", "febrero", "marzo", "abril", "mayo", "junio",
      "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
    ];

    return months[parseInt(monthNumber) - 1];
  }

  function eliminarContenedores() {
    const containers = document.querySelectorAll('.day-container');
    for (let i = containers.length - 1; i > 0; i--) {
      containers[i].parentNode.removeChild(containers[i]);
    }
    dayCount = 1;
  }

  function verContenido() {
    valores.forEach(function(rand) {
      var elemento = document.getElementById(rand);
      elemento.classList.add('ocultar-span');
    });
  }
</script>
{/literal}