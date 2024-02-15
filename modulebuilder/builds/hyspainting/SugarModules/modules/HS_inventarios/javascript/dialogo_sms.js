var qsms_disponibles = 'calculando';
var qsms_celulares = 'calculando';


function dialogo_enviar_qsms(idEquipo, estadoPrestamo, fecha_prestamo) {
  var fechaLabel = 'Fecha de devolución: ...';
  if (estadoPrestamo == 'No' || estadoPrestamo == '') {
    var fechaLabel = 'Fecha de prestamo: ...';
  }
  var modalElement = $("<div><div id='users'><p><label>Seleccione el usuario</label><select class='plantilla' name='plantilla' id='plantilla' style='width: 100%;'><option value='' disabled>Elija el usuario</option> </select></div><label>Seleccione el estado</label ></p><select class='estado' name='estado' id='estado' style='width: 100%;'></select><p> " + fechaLabel + "  <input style='width: 160px; font-size: 0.8em;' class='datetimepicker' type='text' placeholder='Inmediatamente'></p><p style='text-align: center;'></p></div>").dialog({

    title: "Gestión de equipos",
    width: 363,
    close: function () {
      console.log("Modal cerrado");
      $(this).dialog("destroy"); // Destruir el modal cuando se cierra
    },
    buttons: {
      Enviar: function () {
        var date = $(this).find('.datetimepicker').val().trim();
        if (date == '') {
          alert('debe ingresar la fecha y hora');
          return;
        }

        if (fecha_prestamo) {
          const prestamo = new Date(fecha_prestamo);
          const devolucion = new Date(date);
          if (devolucion < prestamo) {
            alert('la fecha de devolución no puede ser menor a la de prestamo');
            return;
          }
        }


        var url = "index.php?entryPoint=GetMethodsInventariosEntryPoint&action=savePrestamo&id=" + encodeURI(idEquipo) + "&usuario=" + encodeURI($(this).find('#plantilla').val()) + "&estado=" + encodeURI($(this).find('#estado').val()) + "&fecha=" + encodeURI(date);

        $(this).dialog("close");
        SUGAR.ajaxUI.showLoadingPanel();
        $.getJSON(
          url, {},
          function (data) {
            location.reload();
            if (!data || !data.enviados || data.enviados == 0) alert(data.enviados);
            else alert('Se enviaron ' + data.enviados + ' mensajes');
          }
        );

      },


    },

    create: function () {
      $(this).find('.qsms_mensaje').on('keyup', function () {

        var caracteres = 306 - $(this).val().length;
        $(this).parent().find('.qsms_caracteres').html(caracteres);
        if (caracteres == 153) {
          alert("Ha superado el maximo de 153 caracteres para el envio de 1 SMS, si continua se concatenaran ambos SMS pero se cobraran 2");
        }

      });
      $('.datetimepicker').datetimepicker({
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"]
      });

      $(this).find('.plantilla').on('change', function () {
        if ($(this).val() != '') {
          $('.qsms_mensaje').prop('disabled', true);
          $('.qsms_mensaje').val('');

        } else {
          $('.qsms_mensaje').prop('disabled', false);

        }

      });

    }


  }); //end confirm dialog

  getEstados();
  var element = document.getElementById('users');
  if (estadoPrestamo == 'No' || estadoPrestamo == '') {
    element.style.display = "block";
    getUser();
  } else {
    element.style.display = "none";
  }
}


function getUser() {


  var select2 = $('.plantilla').select2();
  // Agrega un nuevo elemento


  SUGAR.ajaxUI.showLoadingPanel();
  var url = "index.php?entryPoint=GetMethodsInventariosEntryPoint&action=getUsuarios"
  $.getJSON(
    url, {},
    function (data) {
      SUGAR.ajaxUI.hideLoadingPanel();
      console.log(data);
      for (var i = 0; i < data.length; i++) {
        // $('.plantilla').append('<option value=' + data[i].id + '>' + data[i].user_name + '</option>');
        var option = new Option(data[i].user_name, data[i].id);
        select2.append(option);
      }
      select2.trigger('change');
    }
  );
}

function getEstados() {
  SUGAR.ajaxUI.showLoadingPanel();
  var url = "index.php?entryPoint=GetMethodsInventariosEntryPoint&action=getListas"
  $.getJSON(
    url, {},
    function (data) {
      SUGAR.ajaxUI.hideLoadingPanel();
      console.log(data);
      Object.keys(data).forEach(function (key) {
        var value = data[key];


        $('.estado').append('<option value=' + key + '>' + value + '</option>');
      });
    }
  );
}











