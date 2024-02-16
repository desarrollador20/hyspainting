<script src="modules/HS_Reportes_personalizados/tpls/javascript/alert.min.js"></script>

{if $tipoReporte == 'usuarios'}
<div class="final-buttons">
    <button id="btnUsuarios" class="button" onclick="setExcel();">Exportar Excel</button>
    <button id="btnProyectos" class="button" onclick="setPDF();">Exportar Pdf</button>
    <button id="btnProyectos" class="button"
        onclick="verificarFacturador('trabajadores','HS_Facturador');">Guardar</button>
</div>
{else}
<input type="hidden" id="tipo_cobro" name="tipo_cobro">
<input type="hidden" id="valor_contrato" name="valor_contrato">
<input type="hidden" id="desde_proyecto" name="desde_proyecto">
<input type="hidden" id="hasta_proyecto" name="hasta_proyecto">
<div class="final-buttons">
    <button id="btnUsuarios" class="button" onclick="setExcelProyect();">Exportar Excel</button>
    <button id="btnProyectos" class="button" onclick="setPDFProyect();">Exportar Pdf</button>
    <button id="btnProyectos" class="button"
        onclick="verificarFacturador('proyecto','HS_Facturador_proyectos');">Facturar</button>
</div>
{/if}

{literal}
<style>
    .final-buttons {
        padding-top: 2%;
        display: none;
    }
</style>
{/literal}
{literal}
<script>
    var trabajador = $('#trabajadores option:selected').text();
    function setPDF() {
         trabajador = $('#trabajadores option:selected').text();
        const pdf = new jsPDF();
        const theme = {
            tableLineColor: 200,
            tableLineWidth: 0.1,
            textColor: 50,
            fontSize: 10,
            cellPadding: 2,
            headerColor: 200,
            drawHeaderRow: function (row, data) {
                // Personalizar el color del título
                doc.setTextColor(255, 255, 255);
                doc.setFillColor(100, 100, 100);
                doc.rect(data.settings.margin.left, row.y, data.table.width, row.height, 'F');
            },
        };

        // Iterar sobre cada par de tablas (tabla1 y tabla2)
        for (let i = 0; i < document.querySelectorAll('.table-container table').length; i += 2) {
            pdf.text(55, 10, trabajador);
            const table1 = document.querySelectorAll('.table-container table')[i];
            const table2 = document.querySelectorAll('.table-container table')[i + 1];
            pdf.autoTable({ html: `#${table1.id}`, theme: 'grid', margin: { top: 20 } });
            pdf.autoTable({ html: `#${table2.id}`, theme: 'grid', margin: { left: 100, top: 20 } });

        }
        const resumenTable = document.getElementById('resumen');
        pdf.addPage();
        pdf.autoTable({ html: `#${resumenTable.id}`, theme: 'grid', margin: { top: 20 } });

        // Descargar el archivo PDF
        pdf.save(getname() + '.pdf');

    }
    // Tu código que utiliza jsPDF

    function setExcel(action) {
        const wb = XLSX.utils.book_new();
        const tablesData = [];
        trabajador = $('#trabajadores option:selected').text();

        // Iterar sobre cada tabla y agregar sus datos a la matriz tablesData
        document.querySelectorAll('.table-container table, #resumen').forEach((table, index) => {
            const tableData = [];

            // Iterar sobre las filas de la tabla
            table.querySelectorAll('tr').forEach((row) => {
                const rowData = [];

                // Iterar sobre las celdas de la fila
                row.querySelectorAll('td, th').forEach((cell) => {
                    rowData.push(cell.innerText);
                });

                // Agregar datos de la fila actual a tableData
                tableData.push(rowData);
            });

            // Agregar datos de la tabla actual a tablesData solo si hay al menos una fila
            if (tableData.length > 0) {
                tablesData.push(...tableData);

                // Agregar una fila vacía solo si no es la última tabla
                if (index < document.querySelectorAll('.table-container table, #resumen').length - 1) {
                    const emptyRow = Array.from({ length: tableData[0].length }, () => '');
                    tablesData.push(emptyRow);
                }
            }
        });

        // Crear una hoja de cálculo con los datos combinados de todas las tablas
        const wsFinal = XLSX.utils.aoa_to_sheet(tablesData);
        XLSX.utils.book_append_sheet(wb, wsFinal, 'trabajador'); // Reemplazar 'trabajador' con el valor adecuado

        // Descargar el archivo Excel
        XLSX.writeFile(wb, getname() + '.xlsx');
    }

    function getname() {
        const desde = $("#desde").val();
        const hasta = $("#hasta").val();
        const name = 'Reporte Usuario' + trabajador + ' (' + desde + '-' + hasta + ')';
        return name;
    }

    function getNameProyecto() {
        var proyectoName = $('#proyecto option:selected').text();
        var anio  = $('#year').val();
        var mes   = $('#mes option:selected').text();
        var corte = $('#corte').val();
        const desde = $("#desde").val();
        const hasta = $("#hasta").val();
        
        var corteValidador =  $("#tipo_busqueda").prop("checked");
        if(corteValidador){
           var nameDocuemnto =  `Reporte proyecto ${proyectoName}_${anio}_${mes}_${corte}` ;
        }else{
           var nameDocuemnto =  `Reporte proyecto ${proyectoName} (${desde}-${hasta})` ;
        }
       
        return nameDocuemnto;
    }


    function setFacturadorUsuariosAjax() {
        const id_trabajador = $("#trabajadores").val();
        const desde = $("#desde").val();
        const hasta = $("#hasta").val();

        const subtotal = document.getElementById("subtotal");
        const prestamos = document.getElementById("loan");
        const total = document.getElementById("total");

        const subtotalValue = subtotal.textContent || subtotal.innerText;
        const prestamosValue = prestamos.textContent || prestamos.innerText;
        const totalValue = total.textContent || total.innerText;

        const query = {
            action: 'setFacturador',
            id_trabajador: id_trabajador,
            desde: desde,
            hasta: hasta,
            subtotal: subtotalValue,
            prestamos: prestamosValue,
            total: totalValue
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
                let { results } = data;
                //addTablasdata(data, desde, hasta);
                console.log(data);
                SUGAR.ajaxUI.hideLoadingPanel();


            }
        });

    }


    function setFacturadorUsuarios(desde, hasta, id_trabajador) {
        const subtotal = document.getElementById("subtotal");
        const prestamos = document.getElementById("loan");
        const total = document.getElementById("total");

        const subtotalValue = subtotal.textContent || subtotal.innerText;
        const prestamosValue = prestamos.textContent || prestamos.innerText;
        const totalValue = total.textContent || total.innerText;
        const data = [
            { name: 'desde', valor: desde },
            { name: 'hasta', valor: hasta },
            { name: 'id_trabajador', valor: id_trabajador },
            { name: 'subtotal', valor: subtotalValue },
            { name: 'prestamos', valor: prestamosValue },
            { name: 'total', valor: totalValue },
            { name: 'module', valor: 'HS_Reportes_personalizados' },
            { name: 'action', valor: 'setFacturadorUsuarios' },

        ];

        var formulario = document.createElement('form');
        formulario.method = 'post';
        formulario.action = 'index.php';

        for (let i = 0; i < data.length; i++) {
            var campoNombre = document.createElement('input');
            campoNombre.type = 'text';
            campoNombre.name = data[i].name;  // Nombre del campo en tu script PHP
            campoNombre.value = data[i].valor;
            formulario.appendChild(campoNombre);
        }

        document.body.appendChild(formulario);
        formulario.submit();
    }


    function verificarFacturador(id, modulo) {
        const $idElement = $("#" + id);
        const desdeId = modulo === 'HS_Facturador' ? "#desde" : "#desde_proyecto";
        const hastaId = modulo === 'HS_Facturador' ? "#hasta" : "#hasta_proyecto";

        const $desdeElement = $(desdeId);
        const $hastaElement = $(hastaId);

        const id_trabajador = $idElement.val();
        const desde = $desdeElement.val();
        const hasta = $hastaElement.val();
        const query = {
            action: 'verificarFacturaUsuarios',
            id_trabajador: id_trabajador,
            desde: desde,
            hasta: hasta,
            modulo: modulo,
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
                if (data[0] == "false") {
                    if (modulo === 'HS_Facturador') {
                        setFacturadorUsuarios(desde, hasta, id_trabajador);
                    } else {
                        setFacturadorProyectos();
                    }

                } else {
                    var url = "index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3D" + modulo + "%26offset%3D1%26stamp%3D1701291515051957900%26return_module%3DHS_Facturador%26action%3DDetailView%26record%3D" + data[1];
                    var mensaje = data[0];

                    // Utilizamos SweetAlert con contenido HTML
                    Swal.fire({
                        title: mensaje,
                        html: "<a href='" + url + "' target='_blank'>Ver el registro </a>",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonText: 'OK'

                    });
                    return;
                }


            }
        });
    }

    function setExcelProyect() {
        const wb = XLSX.utils.book_new();
        const tablesData = [];

        // Iterar sobre cada tabla y agregar sus datos a la matriz tablesData
        document.querySelectorAll(' table').forEach((table) => {
            // Aplicar estilos a la tabla para agregar bordes
            //  table.style.border = '1px solid black!important';
            const ws = XLSX.utils.table_to_sheet(table);
            const tableData = XLSX.utils.sheet_to_json(ws, { header: 1 });

            tablesData.push(...tableData);
        });

        // Crear una hoja de cálculo con los datos combinados de todas las tablas
        const wsFinal = XLSX.utils.json_to_sheet(tablesData, { skipHeader: true });
        console.log(tablesData);

        XLSX.utils.book_append_sheet(wb, wsFinal, trabajador);
        // Descargar el archivo Excel
        XLSX.writeFile(wb, getNameProyecto() + '.xlsx');


    }

    function setPDFProyect() {

        // Crear un nuevo objeto jsPDF
        var pdf = new jsPDF();

        // Definir la posición inicial y el encabezado del documento
        var y = 10;
        pdf.text("Reporte de Tiempo", 20, y);

        // Iterar sobre cada tabla y agregarla al documento PDF
        var tables = ['semana1', 'resumen1', 'semana2', 'resumen2'];
        for (var i = 0; i < tables.length; i++) {
            var tableId = tables[i];

            // Agregar la tabla utilizando jsPDF-AutoTable
            pdf.autoTable({ html: '#' + tableId, startY: y + 10 });

            // Ajustar la posición para la próxima tabla
            y = pdf.autoTable.previous.finalY + 10;
        }

        // Guardar el documento PDF como un archivo descargable
        pdf.save(getNameProyecto() + '.pdf');
    }


    function setFacturadorProyectos() {
        const id_proyecto = $("#proyecto").val();
        const tipo_cobro = $("#tipo_cobro").val();
        const valor_contrato = parseFloat($("#valor_contrato").val());
        const desde = $("#desde_proyecto").val();
        const hasta = $("#hasta_proyecto").val();
        var tipo_fecha = $('#tipo_busqueda').is(':checked') ? true : false;
        const corte = $("#corte").val();
        //const valor_pagado;
        // Verifica si el tipo de cobro es 'por_contrato'
        if (tipo_cobro === 'por_contrato') {
            // Solicita al usuario que ingrese el valor pagado
            var valor_pagado = parseFloat(prompt("Ingrese el valor pagado:")) || 0;
            // Verifica si el valor pagado es mayor al valor del contrato
            if (valor_pagado > valor_contrato) {
                alert('El valor pagado no puede ser mayor al valor del contrato');
                return;
            }
            puestos1[tipo_cobro] = {
                regular_hours: 1,
                unitPrice: valor_pagado
            };


        }
        SUGAR.ajaxUI.showLoadingPanel();
        const query = {
            action: 'setFacturadorProyectos',
            id_proyecto: id_proyecto,
            valor_pagado: valor_pagado,
            desde: desde,
            hasta: hasta,
            tipo_fecha: tipo_fecha,
            corte: corte,
            total_horas: totalHoras,
            info: puestos,
            tipo_cobro: tipo_cobro
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
                if (esGUIDValido(data)) {
                    clearDataTablesProyecto();
                    alert('Facturador Proyecto generado con exito');
                }
                SUGAR.ajaxUI.hideLoadingPanel();


            }
        });



    }


    function esGUIDValido(guid) {
        const regex = /^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/;
        return regex.test(guid);
    }

</script>
{/literal}