$(document).ready(function () {

  $("#num_serie").off("change").on("change", function (e) {
    getSerial();
  });

});

function getSerial() {
 let serial= $('#num_serie');
  const query = {
    action: 'getSerial',
    serial: serial.val()
  }

  $.ajax({
    type: "POST",
    url: 'index.php?entryPoint=GetMethodsInventariosEntryPoint',
    data: query,
    dataType: "json",
    error: function (jqXHR, textStatus, errorThrown) {
      console.error(textStatus, jqXHR, errorThrown)
    },
    success: function (data) {
      const  results  = data;
    
      if (results == 'true') {
        alert("El serial "+serial.val()+" ye esta registrado en el sistema");
        serial.val('');
        return;
      }
    }
  });
}

