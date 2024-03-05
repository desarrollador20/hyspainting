

function actualizarMasivo(idsSelecioandos,select_entire_list,current_query_by_page){
    var contenido;
    $("#popupDiv_update").remove();
    contenido = `<div id="popupDiv_update" class="modal fade" >
       <div class="modal-dialog">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Ingrese Valores</h4>
             </div>
             <div class="modal-body">
                <div style="padding: 5px 5px; overflow: auto; height: auto;">
                    <form>
                     <div class="form-group">
                       <label for="h_work">Horas trabajo:</label>
                       <input class="form-control" name="h_work" id="h_work" type="number" step="1" value="0" min="0" oninput="validarInput(this)">
                    </div>
                    <div class="form-group">
                       <label for="h_travel">Horas viaje:</label>
                       <input class="form-control" type="number" name="h_travel" id="h_travel" step="1" value="0" min="0" oninput="validarInput(this)">
                    </div>
                   </form>
                </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                 <button type="button" class="btn btn-success" onclick="validarRegistros('${idsSelecioandos}')">Actualizar Horas</button>
             </div>
           
          </div>
       </div>
    </div>`;
   $(".list-view-rounded-corners").append(contenido);
   $("#popupDiv_update").modal("show",{backdrop: "static"});
}


function validarRegistros(idsRegistros){

    if($("#h_work").val()?.trim() == "" || $("#h_work").val() == 0){
         alert("Por favor ingresa las horas de trabajo a actualizar");
         return false;
    }
    const query = {
        action: 'validarRegistros',
        idsRegistros: idsRegistros,
    }
    SUGAR.ajaxUI.showLoadingPanel();
    $.ajax({
        type: "POST",
        url: 'index.php?entryPoint=GetMethodsRegistroEntryPoint',
        data: query,
        dataType: "json",
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, jqXHR, errorThrown)
        },
        success: function (data) {
            const results = data;
            if (results == 'tiene') {
                var aceptar= confirm("Algunos de los registros seleccionados ya contienen datos ingresados. ¿Estás seguro de que deseas continuar?");
                if(!aceptar){
                    SUGAR.ajaxUI.hideLoadingPanel();
                    return;
                }else{
                    actualizarDatos(idsRegistros);
                }
            }else{
                actualizarDatos(idsRegistros);
            }
        }
    });

}

function actualizarDatos(idsRegistros) {

    
    const query = {
        action: 'actualizarMasivo',
        idsRegistros: idsRegistros,
        horasTrabajo: $("#h_work").val()?.trim(),
        horasViaje: $("#h_travel").val()?.trim()
    }

    $.ajax({
        type: "POST",
        url: 'index.php?entryPoint=GetMethodsRegistroEntryPoint',
        data: query,
        dataType: "json",
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, jqXHR, errorThrown)
        },
        success: function (data) {
            const results = data;
            SUGAR.ajaxUI.hideLoadingPanel();
            if (results == true) {
                alert("Actualización Exitosa");
                location.reload();
            }else{
                alert("Error al actualizar");
                
            }
        }
    });

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