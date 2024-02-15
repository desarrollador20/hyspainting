function pagar(id_factura) {

 
    var aceptar= confirm("¿Estás seguro de que deseas pagar la factura?");
    if(!aceptar){
        return;
    }
    const query = {
        action: 'addPago',
        idFactura: id_factura,
    }
    SUGAR.ajaxUI.showLoadingPanel();
    $.ajax({
        type: "POST",
        url: 'index.php?entryPoint=GetMethodsFacturadorEntryPoint',
        data: query,
        dataType: "json",
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus, jqXHR, errorThrown)
        },
        success: function (data) {
            const results = data;
            if (results == 'true') {
                location.reload();
            
             
            }
        }
    });

}