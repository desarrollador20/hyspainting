
function enviarFactura(idFacturadorProyecto,numFactura,empresa,proyecto) {

    const time = 1;
    SUGAR.ajaxUI.showLoadingPanel();
    
    setTimeout(function() {
        $.ajax({
            type: "POST",
            url: 'index.php?entryPoint=setEmail',
            data: {
                action: 'enviar_factura',
                idFacturadorProyecto:idFacturadorProyecto,
                numFactura: numFactura,
                empresa:empresa,
                proyecto:proyecto
            },
            error: function(xhr, status, error) {
                console.error(error);
            },
            success: function(response) {
                alert(response);
                SUGAR.ajaxUI.hideLoadingPanel();
            }
        });
    }, time);

}

