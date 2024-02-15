
function enviarFactura(idFactura,numFactura) {

    const time = 1;
    SUGAR.ajaxUI.showLoadingPanel();
    
    setTimeout(function() {
        $.ajax({
            type: "POST",
            url: 'index.php?entryPoint=setEmail',
            data: {
                action: 'enviar_factura',
                idFactura: idFactura,
                numFactura: numFactura
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

