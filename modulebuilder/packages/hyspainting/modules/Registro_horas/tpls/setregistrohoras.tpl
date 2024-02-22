<link rel="stylesheet" type="text/css" href="modules/HS_Registro_horas/tpls/styles/view.edit.css" />
<title>Registro de Horas Semanales</title>
<div class="container">
  <h2 id="titulo-registro">Registro de Horas Semanales</h2>

  <form action="index.php" method="POST" name="EditView" id="EditView" enctype="multipart/form-data">
    <table>
      <tr>
        <th colspan="5"><label class="project-label">Semana</label>
          <select id='semanas-select' name="rango">
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
            <h4 style="margin-left: 0;" class='dia'><span>Lunes</span>
              <button type="button" class="add-button">{sugar_getimage name="id-ff-add"
                alt="$app_strings.LBL_ID_FF_ADD"
                ext=".png"}</button>
              <button type="button" onclick="removeReglaItem(this);" class="del-button">{sugar_getimage
                name="id-ff-remove-nobg" alt="$app_strings.LBL_ID_FF_REMOVE" ext=".png"}</button>

            </h4>
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
                <input class="hours-input" name='horas_trabajo_%rand%' type="number" step="0.1" value="0.0" min="0" oninput="validarInput(this)">
                <input class="hours-input" type="number" name='horas_viaje_%rand%' step="0.1" value="0.0" min="0" oninput="validarInput(this)">
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
    <!--  <input id="btncancelb" class="button" type="button" name="button" value="Limpiar >>" onclick="cancelar()"> -->
    </div>
  </form>
</div>

{literal}
<script>
  let dayCount = 1; // Lleva la cuenta de los contenedores de día
  var valores = [];
  var diasRegistrados = {};
  document.addEventListener('DOMContentLoaded', function () {
    getOption();
    $("#semanas-select").off("change").on("change", function (e) {
      eliminarContenedores();
      getRegistros($(this).val());
    });
  });

  function getOption() {
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
    addButton.addEventListener('click', function () {
      addDayContainer2(false, newContainerId);
    });

    if (data.id == 0) {
      valores.push(rand);
      selectProyecto.disabled = false;
    }
    diasRegistrados[fecha.value] = diasRegistrados[fecha.value] === undefined ? 1 : diasRegistrados[fecha.value] + 1;
    // Inserta el contenedor clonado debajo del original
    originalContainer.parentNode.insertBefore(clonedContainer, originalContainer.nextSibling);


  }


  function addDayContainer2(data, contenedor) {
    const originalContainer = document.getElementById(contenedor);
    var inputElement = originalContainer.querySelector('span[name="span"]');
    var deleteButton = originalContainer.querySelectorAll('.del-button');

    if (inputElement.classList == 'ocultar-span') {
      inputElement.classList.remove('ocultar-span');
      deleteButton[0].style.display = 'block';
      return;
    }


    console.log(data);

    dayCount++;

    const clonedContainer = originalContainer.cloneNode(true);

    var deleteButton2 = clonedContainer.querySelectorAll('.del-button');
    deleteButton2[0].style.display = 'block';
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
    span.setAttribute('id', `${rand}`)
    selectProyecto.disabled = false;
    regla.value = rand;
    registroId.value = 0;
    horasTrabajoInput.value = '';
    horasViajeInput.value = '';
    selectProyecto.value = '';
    // Asigna valores a los campos del nuevo contenedor
    //const selectProyecto = clonedContainer.querySelector('select[name="proyecto"]');

    if (diasRegistrados[fecha.value] >= 2) {
      alertas("Ya se ha registrado un día para " + fecha.value + ". No se pueden agregar dos registros en el mismo día.");
      return;
    }

    alertas("el proceso de agregar registro horas es relizado bajo su responsabilidad");
    console.log(diasRegistrados);


    const addButton = clonedContainer.querySelector('.add-button');
    addButton.addEventListener('click', function () {
      addDayContainer2(false, newContainerId);
    });
    diasRegistrados[fecha.value] = diasRegistrados[fecha.value] === undefined ? 1 : diasRegistrados[fecha.value] + 1;
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
      success: function (data) {
        console.log(data) // Resuelve con los datos obtenidos de la llamada AJAX
        drawRegistroHoras(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, jqXHR, errorThrown);

      }
    });
  }

  function siguiente() {
    var bandera = false;
    var elementos = document.querySelectorAll('input[name="regla[]"]');
    for (let i = 1; i < elementos.length; i++) {
      var valor = elementos[i].value;
      console.log(valor);
      var regla = document.querySelector('select[name="project_' + valor + '"]');
      var hora = document.querySelector('input[name="horas_trabajo_' + valor + '"]').value;
      if (regla.value != '') {
        if (!document.getElementById(valor).classList.contains("ocultar-span") && (hora == '' || hora == 0)) {
          console.log(regla.value);
          alert("No deben haber valares de horas vacias o con valores 0");
          return;
        }
      } else {
        var miSpan = document.getElementById(valor);
        if (!miSpan.classList.contains("ocultar-span")) {
          bandera = true;
        }
      }
    }
    if (bandera) {
      alert("Existen registros sin proyectos asignados");
      return;
    }
    document.getElementById('EditView').submit();
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
    valores.forEach(function (rand) {
      var elemento = document.getElementById(rand);
      elemento.classList.add('ocultar-span');
    });
  }

  function removeReglaItem(button) {
    var container = button.closest('.day-container'); // Encuentra el contenedor padre con la clase 'day-container'
    if (container) {
      container.remove(); // Elimina el contenedor y todos sus elementos internos
      const fecha = container.querySelector('input[name^="fecha"]');
      console.log(fecha);
      diasRegistrados[fecha.value] -= 1; // Establece la fecha en falso en el objeto diasRegistrados
    }
  }


  function alertas(mensaje) {
    alert(mensaje);
  }

  function validarInput(inputElement) {
    // Obtener el valor actual del campo
    let valor = parseFloat(inputElement.value);
    // Verificar si el valor es negativo y, si es así, establecerlo en 0
    if (valor < 0  ) {
        inputElement.value = 0;
    } else {
    // Eliminar ceros a la izquierda y establecer el valor
    inputElement.value = parseFloat(valor).toString().replace(/^0+/, '') || '0';
}
}



</script>
{/literal}