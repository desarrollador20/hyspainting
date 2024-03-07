<script type="text/javascript" src="modules/HS_Programador/javascript/select2/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="modules/HS_Programador/javascript/select2/select2.min.css" />
<link rel="stylesheet" type="text/css" href="modules/HS_Reportes_personalizados/tpls/styles/reporte.css" />

<div class="container">
    <h1>Consulta de datos por {$tipoReporte}</h1>
    {include file="modules/HS_Reportes_personalizados/tpls/botones.tpl"}
    <div class="tab-content" style="padding: 0; border: 0;"></div>
    <div class="row edit-view-row">
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="name">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Trabajador:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="name" field="name">
                {html_options name='trabajadores' options=$trabajadores id='trabajadores'}
            </div>
            <!-- [/hide] -->
        </div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="">
        </div>

        <div class="clear"></div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="name">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Desde:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="name" field="name">
                <input type="date" name="desde" id="desde" size="30" maxlength="50" value="" title="">
            </div>
            <!-- [/hide] -->
        </div>
        <div class="col-xs-12 col-sm-6 edit-view-row-item" data-field="name">
            <div class="col-xs-12 col-sm-4 label" data-label="LBL_NAME">
                Hasta:<span class="required">*</span></div>
            <div class="col-xs-12 col-sm-8 edit-view-field " type="name" field="name">
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

    <div>
        <div class="table-container">
            <div class="left-table">
                <table class="" id="tabla1">

                    <!-- Puedes agregar más filas con datos de prueba aquí -->
                </table>
                <div class="right-table">
                    <table class="additional-table" id="reg1">

                    </table>
                </div>
            </div>
            <div class="right-table">
                <table id="tabla2">

                    <!-- Puedes agregar más filas con datos de prueba aquí -->
                </table>
                <div class="right-table">
                    <table class="additional-table" id="reg2">

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="" id="resumen">

            <tbody>

                <!-- Add more rows and data as needed -->
            </tbody>
        </table>
    </div>
    {include file="modules/HS_Reportes_personalizados/tpls/botonesfinal.tpl"}
</div>



{literal}
<script>
    var diasRegistrados = {};
    var resumen = [];
    var valorHoraUser;
    var contador;
    var prestamos

    $(document).ready(function () {

        // Muestra una alerta cuando el documento esté listo
        var select2 = $('#trabajadores').select2();
        $("#buscar").off("click").on("click", function (e) {
            getData();
        });
        $("#desde ").off("change").on("change", function (e) {
            verificarFechas();
        });
        $("#hasta ").off("change").on("change", function (e) {
            verificarFechas();
        });
    });

    function getData() {
        const id_trabajador = $("#trabajadores").val();
        const desde = $("#desde").val();
        const hasta = $("#hasta").val();
        const query = {
            action: 'getReporteUser',
            id_trabajador: id_trabajador,
            desde: desde,
            hasta: hasta,
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
                addTablasdata(data, desde, hasta);
                SUGAR.ajaxUI.hideLoadingPanel();


            }
        });
    }

    function verificarFechas() {
        // Supongamos que tienes dos fechas
        const fecha1 = $("#desde").val();
        const fecha2 = $("#hasta").val();

        if (fecha1 == '' || fecha2 == '') {
            return;
        }

        var desde = new Date(fecha1);
        var hasta = new Date(fecha2); // La fecha actual
        // Restar las fechas para obtener la diferencia en milisegundos
        var diferenciaEnMilisegundos = hasta - desde;

        // Convertir la diferencia en días (1 día = 24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
        var diferenciaEnDias = diferenciaEnMilisegundos / (24 * 60 * 60 * 1000);
        console.log(diferenciaEnDias);


        // Verificar si la diferencia no supera los 14 días
        if (diferenciaEnDias < 14) {
            document.getElementById('buscar').style.display = 'block';
        } else {
            alert('la diferencia en fechas no puede superar los 14 dias');
            document.getElementById('buscar').style.display = 'none';
        }

    }

    function addTablasdata(data, ini, end) {
        clearDataTables();
        hidenFinalButtons('none');
        console.log(data);
        if (data[0].length == 0) {
            alert('no hay información registrada en las fechas seleccionadas para el usuario');
            return;
        }
        datos = data[0];
        const partesFecha = ini.split('-');
        valorHoraUser = parseFloat(datos[0].valor_hora);
        prestamos = parseFloat(data[2]);
        const inicio = new Date(datos[0].fecha + "T19:00:00");
        const fechaInicio = new Date(
            parseInt(partesFecha[0], 10),
            parseInt(partesFecha[1], 10) - 1, // Resta 1 del mes ya que los meses en JavaScript se cuentan desde 0 (enero) a 11 (diciembre).
            parseInt(partesFecha[2], 10)
        );
        contador = 0;
        const fechaFinalizacion = new Date(end);
        var bandera1 = true;
        var bandera2 = true;
        const sabado = ultimoSabado(inicio);
        var maxHoraViajeUsuario = 0;
        var bandera_desborde_horas_viaje = 0;
        // console.log(sabado);

        // Limpia las dos tablas
        let tabla1 = $("#tabla1");
        let tabla2 = $("#tabla2");

        let semanaActual = 1;  // Comenzamos con la semana 1
        let diaSemana = -1;    // -1 representa un valor no válido (fuera de los días de la semana)

        const cantDias = data[1].dateCounts;
        const totales = data[1].hoursSum;
        const horasPorProyecto1 = {};
        const horasPorProyecto2 = {};
        resumen = [];

        for (let i = 0; i < datos.length; i++) {
            var columna = '';
            var horas_viaje = 0;
            var horas_trabajo = 0;
            if (datos[i].fecha in cantDias) {
                let ctrepetidos = cantDias[datos[i].fecha];
                delete cantDias[[datos[i].fecha]];
                let total = totales[[datos[i].fecha]] * datos[i].valor_hora
                columna = `</td><td rowspan="${ctrepetidos}">$${total}</td></tr>`
            }
            const fechaRegistro = new Date(datos[i].fecha + "T19:00:00");
            console.log(fechaRegistro);

            const fecha = cambiarFormatoFecha(datos[i].fecha);
            if(datos[i].max_horas_viaje_usuario != "0.0" && datos[i].horas_viaje > datos[i].max_horas_viaje_usuario){
                bandera_desborde_horas_viaje+=bandera_desborde_horas_viaje+1;
            }
            //  var horas_viaje = parseFloat(datos[i].horas_viaje);
            maxHoraViajeUsuario = (datos[i].max_horas_viaje_usuario != "0.0" && datos[i].horas_viaje > datos[i].max_horas_viaje_usuario) ? datos[i].max_horas_viaje_usuario : datos[i].horas_viaje;            
            var horas_viaje = (datos[i].horas_viaje !== null && !isNaN(parseFloat(datos[i].horas_viaje))) ? parseFloat(maxHoraViajeUsuario) : 0;
            //  var horas_trabajo = parseFloat(datos[i].horas_trabajo);
            var horas_trabajo = (datos[i].horas_trabajo !== null && !isNaN(parseFloat(datos[i].horas_trabajo))) ? parseFloat(datos[i].horas_trabajo) : 0;
            var inf = datos[i].pago_extra;
            var horas = horas_trabajo + horas_viaje;
            var valor = horas * parseFloat(datos[i].valor_hora);
            var proyecto = datos[i].nombre_proyecto;


            if (fechaRegistro <= sabado) {
                if (bandera1) {
                    tabla1.append("<tr><th>Fecha</th><th>Proyecto</th><th>Horas</th><th>Valor</th></tr>");
                    bandera1 = false;
                }
                tabla1.append(`<tr ><td>${datos[i].dia}, ${fecha}</td><td>${datos[i].nombre_proyecto}</td><td>${(inf == '^overtime^') ? horas_trabajo : horas}</td>${columna}</tr>`);                
                if (!horasPorProyecto1[proyecto]) {
                    // Inicializa un objeto con información adicional
                    horasPorProyecto1[proyecto] = {
                        horasTotales: 0,
                        proyectoInfo: inf/* Agrega detalles adicionales aquí */
                    };
                }
                //horasPorProyecto1[proyecto].horasTotales += horas;

                horasPorProyecto1[proyecto].horasTotales += (inf == '^overtime^') ? horas_trabajo : horas;

            } else {

                if (bandera2) {
                    tabla2.append("<tr><th>Fecha</th><th>Proyecto</th><th>Horas</th><th>Valor</th></tr>");
                    bandera2 = false;
                }
                tabla2.append(`<tr ><td>${datos[i].dia}, ${fecha}</td><td>${datos[i].nombre_proyecto}</td><td>${horas}</td>${columna}</tr>`);
                if (!horasPorProyecto2[proyecto]) {
                    // Inicializa un objeto con información adicional
                    horasPorProyecto2[proyecto] = {
                        horasTotales: 0,
                        proyectoInfo: inf
                    };
                }
                horasPorProyecto2[proyecto].horasTotales += (inf == '^overtime^') ? horas_trabajo : horas;
                contador++
            }


        }
        addRegTable(horasPorProyecto1, 'reg1');
        addRegTable(horasPorProyecto2, 'reg2');
        drawTablaResumen();

         // aviso al usuario que hubo desvorde en registro de horas de viaje 
        $("#div_desborde_horas_viaje").remove();
        if(bandera_desborde_horas_viaje > 0){
              $(".edit-view-row").after(`<div id="div_desborde_horas_viaje">
                <p style="color:red">Existen registros cuyas horas de viaje exceden el límite permitido. Para estos casos, se ajustarán las horas de viaje al máximo establecido para el usuario en el proyecto, que es de: ${maxHoraViajeUsuario} horas.</p>
            </div>`);
        }



    }

    // Ejemplo de uso:

    function addRegTable(data, id_tabla) {

        var regHoras = 0;
        var otHoras = 0;
        maximoOt = 40;
        $("#" + id_tabla).empty();
        if (!Object.keys(data).length > 0) {
            return;
        }
        for (const proyecto in data) {
            if (data.hasOwnProperty(proyecto)) {
                const infoProyecto = data[proyecto];
                const horasTotales = parseFloat(infoProyecto.horasTotales);
                const proyectoInfo = infoProyecto.proyectoInfo;
                otHoras
                if ((infoProyecto.proyectoInfo == '^overtime^' || infoProyecto.proyectoInfo == '^travel^,^overtime^') && horasTotales > maximoOt) {
                    let aux = horasTotales - maximoOt
                    otHoras += aux;
                    regHoras += maximoOt;

                } else {
                    regHoras += horasTotales;
                }

            }
        }

        let tabla = $("#" + id_tabla);
        tabla.append(`<tr> <th>Reg Hours</th> <td>${regHoras}</td> </tr>`);
        tabla.append(`<tr> <th>OT Hours</th> <td>${otHoras}</td> </tr>`);
        addResumentable(regHoras, otHoras);


    }

    function addResumentable(regHour, otHour) {
        var rand = Math.ceil(Math.random() * 899999 + 100000);
        const miSelect = $('#trabajadores');
        // Obtiene el label (texto) de la opción seleccionada
        const nameTrabajador = miSelect.find('option:selected').text();
        // Muestra el label en el div
        var elemento = document.querySelector("#resumen");
        var thead = document.querySelector("#resument");
        var rateOthour = valorHoraUser * 1.5;
        var amRegHour = regHour * valorHoraUser;
        var amOtHour = otHour * rateOthour;
        var sumAllHour = amRegHour + amOtHour;
        let tdTrabajador = '';

        resumen.push({
            trabajador: nameTrabajador,
            regHour: regHour,
            otHour: otHour,
            rateOthour: rateOthour,
            amRegHour: amRegHour,
            amOtHour: amOtHour,
            sumAllHour: sumAllHour
        });


    }

    function ultimoSabado(fecha) {
        const diaSemana = fecha.getDay(); // Obtiene el día de la semana (0: Domingo, 1: Lunes, ..., 6: Sábado)
        const diferenciaDias = 6 - diaSemana; // Calcula la diferencia de días para llegar al próximo sábado
        fecha.setDate(fecha.getDate() + diferenciaDias); // Suma la diferencia de días a la fecha original

        return fecha;
    }


    function drawTablaResumen() {
        var longitud = resumen.length;
        var sub = 0;
        var tabla_resumen = $('#resumen');
        tabla_resumen.append(`<thead id="resument"><tr><th>Name worker</th><th>Reg Hours Worked</th><th>OT Hours Worked</th><th>Rate Reg Hours</th><th>Rate OT Hours</th><th>Ammount Reg Hours</th> <th>Ammount OT Hours</th><th>Sub Total week</th><th>Sub total</th> <th>Loan</th><th>Total</th></tr></thead>`);
        var tdTrabajador;
        var sbTotal;
        var total;
        var loan;
        for (var i = 0; i < longitud; i++) {
            var elemento = resumen[i];
            sub += elemento.sumAllHour;
            if (longitud == 1) {
                let rowspan = 1;
                tabla_resumen.append(`<tr id="first"><td>${elemento.trabajador}</td><td>${elemento.regHour}</td> <td>${elemento.otHour}</td><td>${valorHoraUser}</td><td>${elemento.rateOthour}</td><td>${elemento.amRegHour}</td>  <td>${elemento.amOtHour}</td><td>${elemento.sumAllHour}</td><td id="subtotal">${sub}</td><td id="loan">${prestamos}</td><td id="total">${sub - prestamos}</td></tr>`);
                break;
            }
            if (i == 0) {
                tdTrabajador = `<td rowspan="${longitud}">${elemento.trabajador}</td>`;
                sbTotal = `<td id="subtotal" rowspan="${longitud}"></td>`;
                loan = `<td id="loan" rowspan="${longitud}">${prestamos}</td>`;
                total = `<td id="total" rowspan="${longitud}"></td>`;
            }
            tabla_resumen.append(`<tr id="first">${tdTrabajador}<td>${elemento.regHour}</td> <td>${elemento.otHour}</td><td>${valorHoraUser}</td><td>${elemento.rateOthour}</td><td>${elemento.amRegHour}</td>  <td>${elemento.amOtHour}</td><td>${elemento.sumAllHour}</td>${sbTotal}${loan}${total}</tr>`);
            tdTrabajador = ''
            sbTotal = '';
            total = '';
            loan = '';
            // Continúa accediendo a otras propiedades aquí
        }
        $("#subtotal").text(sub);
        $("#total").text(sub - prestamos);
        hidenFinalButtons('block');


    }




    function cambiarFormatoFecha(fecha) {
        // Divide la fecha en año, mes y día
        var partes = fecha.split("-");

        // Reorganiza las partes de la fecha en el nuevo formato
        var nuevaFecha = partes[2] + "/" + partes[1] + "/" + partes[0];

        return nuevaFecha;
    }

    function clearDataTables() {
        const tables = ['tabla1', 'tabla2', 'resumen', 'reg1', 'reg2'];
        tables.forEach((tableName) => {
            console.log(`Nombre de la tabla: ${tableName}`);
            $(`#${tableName}`).empty();
        });


    }

    function hidenFinalButtons(action) {
        var elementos = document.querySelectorAll(".final-buttons");
        elementos.forEach(function (elemento) {
            elemento.style.display = action; // Cambia el estilo para hacer visible
        });

    }




</script>

{/literal}