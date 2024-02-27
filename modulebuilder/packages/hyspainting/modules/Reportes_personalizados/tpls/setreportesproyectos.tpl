<script type="text/javascript" src="modules/HS_Programador/javascript/select2/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="modules/HS_Programador/javascript/select2/select2.min.css" />

{literal}
<style>
    /* Estilos CSS según tus preferencias */
    table {
        width: 95%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .table-responsive-resumen {
        overflow-x: auto;
        width: 40%;
    }

    @media (max-width: 600px) {

        th,
        td {
            display: block;
            width: 100%;
        }

        th {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            margin-bottom: 15px;
        }

        td {
            border: none;
            position: relative;
            padding-left: 50%;
            border-bottom: 1px solid #ddd;
        }

        td:before {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }
    }
</style>
{/literal}

<div class="container">
    <h1>Consulta de datos por {$tipoReporte}</h1>
    {include file="modules/HS_Reportes_personalizados/tpls/botones.tpl"}
    <div class="tab-content" style="padding: 0; border: 0;"></div>

    <div class="row edit-view-row">
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="tipo_busqueda">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Por cortes:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="tipo_busqueda" field="tipo_busqueda">
                <input type="checkbox" checked class="listview-checkbox" name="tipo_busqueda" id="tipo_busqueda">
            </div>
            <!-- [/hide] -->
        </div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="">

        </div>

        <div class="clear"></div>


        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="proyecto">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Proyecto:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="proyecto" field="proyecto">
                {html_options name='proyecto' options=$proyectos id='proyecto'}
            </div>
            <!-- [/hide] -->
        </div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="year">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Año:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="year" field="year">
                {html_options name='year' options=$anios id='year' selected=$year}
            </div>
        </div>

        <div class="clear"></div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="mes">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Mes:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="mes" field="mes">
                {html_options name='mes' options=$meses id='mes' selected=$mes}
            </div>
            <!-- [/hide] -->
        </div>


        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="corte">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Corte:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="corte" field="corte">
                { html_options name='corte' options=$corte id='corte'}
            </div>
            <!-- [/hide] -->
        </div>
        <div class="clear"></div>

        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="desde">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Desde:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="name" field="desde">
                <input type="date" name="desde" id="desde" size="30" maxlength="50" value="" title="">
            </div>
            <!-- [/hide] -->
        </div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="hasta">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Hasta:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="name" field="hasta">
                <input type="date" name="hasta" id="hasta" size="30" maxlength="50" value="" title="">
            </div>
            <!-- [/hide] -->
        </div>


        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="name">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                <span class="required"></span>
            </div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="name" field="name">
                <button id="buscar" class="button">Buscar</button>
            </div>
            <!-- [/hide] -->
        </div>
    </div>


    <div id="cont1" class="row edit-view-row">
    </div>

    <div>
        <table id="semana1">
        </table>
    </div>
    <div class="table-responsive-resumen">
        <table id="resumen1">
        </table>
    </div>
    <div id="cont2" class="row edit-view-row">
    </div>
    <div>
        <table id="semana2">
        </table>
    </div>
    <div class="table-responsive-resumen">
        <table id="resumen2">
        </table>
    </div>
    {include file="modules/HS_Reportes_personalizados/tpls/botonesfinal.tpl"}
</div>



{literal}
<script>
    var totalHoras;
    var puestos1 = {};
    var puestos2 = {};
    const puestos = [puestos1, puestos2];
    var valores_pagar;
    $(document).ready(function () {
        // Muestra una alerta cuando el documento esté listo
        var select2 = $('#proyecto').select2();
        $("#buscar").off("click").on("click", function (e) {
            getDataProject();
        });

        $("#tipo_busqueda").off("change").on("change", function (e) {
            getFechas();
        });

        $("#proyecto").on("change", function (e) {
            clearDataTablesProyecto();
            getInfoProyecto();
        });

        $("#year, #mes, #corte").off("change").on("change", function (e) {
            clearDataTablesProyecto();
        });
        hideInputs(['year', 'mes', 'corte'], ['desde', 'hasta']);
        getInfoProyecto();
    });

    function getFechas() {
        var miCheckbox = $('#tipo_busqueda');
        var ocultar;
        var mostrar;
        if (miCheckbox.is(':checked')) {
            ocultar = ['desde', 'hasta'];
            mostrar = ['year', 'mes', 'corte'];
        } else {
            mostrar = ['desde', 'hasta'];
            ocultar = ['year', 'mes', 'corte'];

        }
        hideInputs(mostrar, ocultar);
    }

    function hideInputs(mostrar, ocultar) {
        for (let i = 0; i < mostrar.length; i++) {
            $('#' + mostrar[i]).closest('.edit-view-row-item').show();
        }
        for (let i = 0; i < ocultar.length; i++) {
            $('#' + ocultar[i]).closest('.edit-view-row-item').hide();
        }
    }

    function getDataProject() {
        const fechas = ['desde', 'hasta'];
        const cortes = ['year', 'mes', 'corte'];
        const desde_proyecto = $("#desde_proyecto");
        const hasta_proyecto = $("#hasta_proyecto");
        var valores = [];
        var miCheckbox = $('#tipo_busqueda');
        valores = cortes;
        if (!miCheckbox.is(':checked')) {
            if (verificarFechasProyectos()) {
                return;
            }
            valores = fechas;
        }
        const id_proyecto = $("#proyecto").val();
        const query = {
            action: 'getReporteProject',
            id_proyecto: id_proyecto,
        }
        for (let i = 0; i < valores.length; i++) {
            query[valores[i]] = $("#" + valores[i]).val();
        }
        SUGAR.ajaxUI.showLoadingPanel();
        $.ajax({
            type: "POST",
            url: 'index.php?entryPoint=GetMethodsReportesEntryPoint',
            data: query,
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, jqXHR, errorThrown)
            },
            success: function (data) {
                let { results } = data;
                console.log(data);
                addTablasdataProyecto(data[0]);
                desde_proyecto.val(data[1]);
                hasta_proyecto.val(data[2])
                SUGAR.ajaxUI.hideLoadingPanel();
            }
        });



    }

    function addHeadTable(table) {

        const tabla = document.getElementById(table);
        const encabezado = tabla.createTHead();
        const filaEncabezado = encabezado.insertRow();

        const thNombre = document.createElement('th');
        thNombre.textContent = 'Full Name';
        filaEncabezado.appendChild(thNombre);

        const thClear = document.createElement('th');
        thClear.textContent = '';
        filaEncabezado.appendChild(thClear);
        tabla.createTBody()

    }


    function obtenerSemanas(data) {
        var valores = [];
        var allDates = [];
        // Iterar sobre cada usuario en los datos para obtener todas las fechas
        for (var usuario in data) {
            if (data.hasOwnProperty(usuario)) {
                var registros = data[usuario];
                for (var i = 0; i < registros.length; i++) {
                    var registro = registros[i];
                    if (allDates.indexOf(registro.fecha) === -1) {
                        allDates.push(registro.fecha);
                    }
                }
            }
        }
        // Ordenar las fechas de manera ascendente
        allDates.sort();
        var valores = allDates.length > 7 ?
            [allDates.slice(0, Math.ceil(allDates.length / 2)), allDates.slice(Math.ceil(allDates.length / 2))] :
            [allDates];

        return valores;
    }



    function addTablasdataProyecto(data) {
        clearDataTablesProyecto();
        hidenFinalButtons('none');
        if (data.length === 0) {
            alert('no hay información registrada en las fechas seleccionadas para el proyecto');
            return;
        }
        var nameTable;
        var nameTableResumen;
        const limiteHoras = 40;
        var allDates;
        totalHoras = 0;
        const tipo_cobro = $("#tipo_cobro").val();
        // var allDates = [];
        var fechas = obtenerSemanas(data);
        Object.keys(puestos1).forEach(key => delete puestos1[key]);
        Object.keys(puestos2).forEach(key => delete puestos2[key]);
        for (var v = 0; v < fechas.length; v++) {
            allDates = fechas[v];
            nameTable = 'semana' + (v + 1);
            nameTableResumen = 'resumen' + (v + 1);

            /*
               // Iterar sobre cada usuario en los datos para obtener todas las fechas
               for (var usuario in data) {
                   if (data.hasOwnProperty(usuario)) {
                       var registros = data[usuario];
                       for (var i = 0; i < registros.length; i++) {
                           var registro = registros[i];
                           if (allDates.indexOf(registro.fecha) === -1) {
                               allDates.push(registro.fecha);
                           }
                       }
                   }
               }
               // Ordenar las fechas de manera ascendente
               allDates.sort();
               */
            addHeadTable(nameTable);
            var headerRow = document.querySelector('#' + nameTable + ' thead tr');
            // Agregar fechas al encabezado


            for (var i = 0; i < allDates.length; i++) {
                var fecha = allDates[i];
                var th = document.createElement('th');
                th.textContent = fecha;
                headerRow.appendChild(th);
            }
            headerRow.appendChild(document.createElement('th')).textContent = 'Subtotal';
            // Agregar columna para el total de horas
            // headerRow.appendChild(document.createElement('th')).textContent = 'Subtotal';

            // Obtener el cuerpo de la tabla
            var tbody = document.querySelector('#' + nameTable + ' tbody');
            var sumRegHour = 0;
            var sumOtHour = 0;
            var sumTrHour = 0;
            // Iterar sobre cada usuario y llenar los datos en la tabla
            for (var usuario in data) {
                if (data.hasOwnProperty(usuario)) {

                    var registros = data[usuario];
                    var pago_extra = registros[0].pago_extra;
                    var userRow = document.createElement('tr');
                    var trOthour = document.createElement('tr');
                    var trTrahour = document.createElement('tr');
                    var clear = document.createElement('tr');
                    var subtotalHorasUsuario = 0; // Subtotal de horas trabajadas por usuario
                    var subtotalHorasViaje = 0;
                    var otHourTotal = 0;
                    var trHourTotal = 0;
                    // Agregar nombre de usuario en la primera celda
                    var nameCell = document.createElement('td');
                    nameCell.textContent = registros[0].name;
                    nameCell.rowSpan = 3
                    userRow.appendChild(nameCell);
                    var nameCell = document.createElement('td');
                    nameCell.textContent = 'REG HOURS WORKED';
                    userRow.appendChild(nameCell);

                    var otHour = document.createElement('td');
                    otHour.textContent = 'OT HOURS WORKED';
                    trOthour.appendChild(otHour);

                    var trHour = document.createElement('td');
                    trHour.textContent = 'TRAVEL HOURS';
                    trTrahour.appendChild(trHour);
                    // Iterar sobre cada fecha en el encabezado
                    var registro = null;
                    for (var j = 0; j < allDates.length; j++) {
                        var fecha = allDates[j];
                        // Encontrar el registro correspondiente a esta fecha y usuario
                        for (var k = 0; k < registros.length; k++) {
                            if (registros[k].fecha === fecha) {
                                registro = registros[k];
                                break;
                            }
                        }
                        // Agregar celda con datos del registro 
                        var horas_trabajo = document.createElement('td');
                        var cell2 = document.createElement('td');
                        var horas_viaje = document.createElement('td');
                        var clearCell = document.createElement('td');
                        if (registro) {
                            var cellId = usuario + '-' + fecha;
                            horas_trabajo.textContent = registro.horas_trabajo;
                            horas_viaje.textContent=  (pago_extra?.includes('travel')) ? registro.horas_viaje : ''
                          //  horas_viaje.textContent = registro.horas_viaje;
                            if (registro.horas_trabajo !== null && !isNaN(parseFloat(registro.horas_trabajo))) {
                                subtotalHorasUsuario += parseFloat(registro.horas_trabajo);
                            }
                            if (registro.horas_trabajo) {
                                subtotalHorasViaje += parseFloat(registro.horas_viaje);
                            }



                        }
                        userRow.appendChild(horas_trabajo);
                        trOthour.appendChild(cell2);
                        trTrahour.appendChild(horas_viaje)
                        clear.appendChild(clearCell)
                    }
                    var otHourTotal = 0;
                    var trHourTotal = 0;

                    if (pago_extra == '^overtime^' && subtotalHorasUsuario > limiteHoras) {
                        otHourTotal = subtotalHorasUsuario - limiteHoras;
                        subtotalHorasUsuario = limiteHoras;
                    } else if (pago_extra == '^travel^') {
                        subtotalHorasUsuario += subtotalHorasViaje;

                    } else if (pago_extra == '^travel^,^overtime^') {
                        let aux = subtotalHorasUsuario += subtotalHorasViaje
                        if (aux > limiteHoras) {
                            otHourTotal = aux - limiteHoras;
                            subtotalHorasUsuario = limiteHoras;
                        }

                    }
                    userRow.appendChild(document.createElement('td')).textContent = subtotalHorasUsuario;
                    trOthour.appendChild(document.createElement('td')).textContent = otHourTotal
                    trTrahour.appendChild(document.createElement('td')).textContent = subtotalHorasViaje;

                    if (tipo_cobro === 'por_horas' && registro !== null) {
                        let currentPuesto = puestos[v];
                        if (!currentPuesto[registro.puesto]) {
                            // Inicializa un objeto con información adicional
                            currentPuesto[registro.puesto] = {
                                regular_hours: 0,
                                overtime_hours: 0

                            };
                        }
                        currentPuesto[registro.puesto].regular_hours += subtotalHorasUsuario;
                        currentPuesto[registro.puesto].overtime_hours += otHourTotal;
                        currentPuesto[registro.puesto].fecha = fecha;
                        currentPuesto[registro.puesto].unitPrice = valores_pagar.find(item => item.puesto === registro.puesto)?.valor
                    }
                    // Agregar celda con el subtotal de horas para el usuario
                    var subtotalCell = document.createElement('td');
                    subtotalCell.textContent = subtotalHorasUsuario.toFixed(2);
                    //userRow.appendChild(subtotalCell);

                    // Agregar la fila del usuario al cuerpo de la tabla
                    tbody.appendChild(userRow);
                    tbody.appendChild(trOthour);
                    tbody.appendChild(trTrahour);
                    tbody.appendChild(clear);

                }
                sumRegHour += subtotalHorasUsuario;
                sumOtHour += otHourTotal;
                sumTrHour += subtotalHorasViaje;

            }
            var auxTotalHoras = sumRegHour + sumOtHour + sumTrHour;


            addTalbleProjectResumen(sumRegHour, sumOtHour, sumTrHour, nameTableResumen);
            addlabelSemana(fecha, v + 1);
            totalHoras += auxTotalHoras;
        }
        console.log(puestos);
        hidenFinalButtons('block');
    }

    function addTalbleProjectResumen(sumRegHour, sumOtHour, sumTrHour, idTabla) {
        const data = [
            { categoria: 'REGULAR HOURS', horas: sumRegHour },
            { categoria: 'OVERTIME HOURS', horas: sumOtHour },
            { categoria: 'TRAVEL HOURS', horas: sumTrHour },
            { categoria: 'TOTAL HOURS', horas: sumRegHour + sumOtHour + sumTrHour },
        ];

        const tabla = document.getElementById(idTabla);

        for (let i = 0; i < data.length; i++) {
            const fila = tabla.insertRow();
            const celdaCategoria = fila.insertCell(0);
            const celdaHoras = fila.insertCell(1);
            celdaCategoria.textContent = data[i].categoria;
            celdaHoras.textContent = data[i].horas;
        }

    }

    function clearDataTablesProyecto() {

        const tables = ['semana1', 'resumen1', 'semana2', 'resumen2'];
        const labels = ['cont1', 'cont2'];
        tables.forEach((tableName) => {
            console.log(`Nombre de la tabla: ${tableName}`);
            $(`#${tableName}`).empty();
        });

        labels.forEach((label) => {
            var container = document.getElementById(label);
            // Remove all child elements of the container
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
        });
        hidenFinalButtons('none');
    }

    function addlabelSemana(fecha, id) {
        var container = document.getElementById('cont' + id)
        var rowDiv = document.createElement('div');
        rowDiv.className = 'row edit-view-row';
        var item1Div = document.createElement('div');
        item1Div.className = 'col-xs-12 col-sm-6 edit-view-row-item';
        item1Div.setAttribute('data-field', 'name');
        var label1Div = createLabelDiv('LBL_NAME', 'TIME REPORT FOR WEEK ENDING: ' + fecha);
        item1Div.appendChild(label1Div);


        rowDiv.appendChild(item1Div);

        // Create the second col-xs-12 col-sm-6 edit-view-row-item div
        var item2Div = document.createElement('div');
        item2Div.className = 'col-xs-12 col-sm-6 edit-view-row-item';
        item2Div.setAttribute('data-field', '');


        var label2Div = createLabelDiv('LBL_NAME', 'Week No: ' + id);
        item2Div.appendChild(label2Div);

        rowDiv.appendChild(item2Div);
        container.appendChild(rowDiv);


    }

    function createLabelDiv(dataLabel, content) {
        var labelDiv = document.createElement('div');
        labelDiv.className = 'col-xs-12 col-sm-8 label';
        labelDiv.setAttribute('data-label', dataLabel);
        labelDiv.textContent = content;
        return labelDiv;
    }

    function hidenFinalButtons(action) {
        var elementos = document.querySelectorAll(".final-buttons");
        elementos.forEach(function (elemento) {
            elemento.style.display = action; // Cambia el estilo para hacer visible
        });

    }


    function verificarFechasProyectos() {
        // Supongamos que tienes dos fechas
        const fecha1 = $("#desde").val();
        const fecha2 = $("#hasta").val();

        if (fecha1 == '' || fecha2 == '') {
            alert('Debe ingresar las fechas');
            return true;
        }



        var desde = new Date(fecha1);
        var hasta = new Date(fecha2); // La fecha actual
        // Restar las fechas para obtener la diferencia en milisegundos

        if (desde > hasta) {
            alert('La fecha desde no puede ser menor a hasta');
            return true;
        }
        var diferenciaEnMilisegundos = hasta - desde;

        // Convertir la diferencia en días (1 día = 24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
        var diferenciaEnDias = diferenciaEnMilisegundos / (24 * 60 * 60 * 1000);
        console.log(diferenciaEnDias);


        // Verificar si la diferencia no supera los 14 días
        if (diferenciaEnDias > 17) {
            alert('la diferencia en dias no puede superar los 16');
            return true;
        }
        return false;

    }

    function getInfoProyecto() {
        const tipo_cobro = $("#tipo_cobro");
        const valor_contrato = $("#valor_contrato")
        const id_proyecto = $("#proyecto").val();
        const query = {
            action: 'getInfoProyecto',
            id_proyecto: id_proyecto,
        }
        $.ajax({
            type: "POST",
            url: 'index.php?entryPoint=GetMethodsReportesEntryPoint',
            data: query,
            dataType: "json",
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, jqXHR, errorThrown)
            },
            success: function (data) {
                tipo_cobro.val(data.tipo_cobro);
                valor_contrato.val(data.valor_contrato);
                valores_pagar = data.valor_pagar;

                console.log(valores_pagar);

            }
        });
    }

</script>
{/literal}