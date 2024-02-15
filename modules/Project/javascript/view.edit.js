$(document).ready(function () {

  const campos = ["valor_contrato_c", "valor_pagado_c", "dias_gracia_c"];
  var valor_contrato = $('#valor_contrato_c').val();
  var createInviteesElement = document.getElementById("create-invitees");
  //createInviteesElement.style.display = "none";
  const tipo_cobro = $("#tipo_cobro_c").val();
  showTipoCobro(tipo_cobro);
  campos.forEach((campo) => {
    $("#" + campo).on("blur", validarValorContrato);
    $("#" + campo).off("keyup").on("keyup", function () {
      changeChar(campo);
    });
  });

  $('#tipo_cobro_c').change(function () {
    showTipoCobro($(this).val());
  });

  hideContactsDelayed();
  ocultarDate();

  let registro = document.getElementsByName('record')[0].value;
  console.log(registro);
  if (registro == '') {
    var id = document.getElementById('assigned_user_id').value;
    setTimeout(function () {
      SugarWidgetScheduleRow.deleteRow(id);
    }, 450);

  }

});

function validarValorContrato() {
  const valor_contrato = $('#valor_contrato_c').val();
  const valor_pagado = $('#valor_pagado_c').val();
  if (valor_pagado > valor_contrato) {
    alert('El valor pagado no puede ser mayor al valor del contrato');
    $('#valor_pagado_c').val('');

  }
}


const changeChar = (id_elem) => {
  let elemento = document.getElementById(id_elem);
  elemento.value = elemento.value.replace(/[^0-9,.]+/g, '');
};

function check_form(formname) {
  if (!validarValorPuesto()) {
    alert('Debe ingresar todos los valores a pagar y deben ser mayores a (0)');
    return false;
  }
  if (validate_form(formname, '')) {
    return true;
  }
}

function validarValorPuesto() {
  var valorNombre = $('[name="regla[]"]');
  for (var i = 1; i < valorNombre.length; i++) {
    var data = valorNombre[i].value;
    var elementoValor = $('[name="valor_' + data + '"]');
    if (elementoValor.length) {
      var valorElemento = elementoValor.val();
      if (valorElemento === '' || parseFloat(valorElemento) === 0) {
        // El elemento está vacío o es igual a cero
        return false;

      }
    }
  }
  return true;
}



function showTipoCobro(value) {
  var valorContrato = $("#valor_contrato_c");
  var valorPagado = $("#valor_pagado_c");
  var valoresPagar = $('[data-field="valores_pagar_c"]');

  if (value === 'por_horas') {
    valorContrato.closest("div.edit-view-row-item").hide();
    valorPagado.closest("div.edit-view-row-item").hide();
    valoresPagar.show();
    removeFromValidate('EditView', 'valor_contrato_c');
    removeFromValidate('EditView', 'valor_pagado_c');
  } else {
    valorContrato.closest("div.edit-view-row-item").show();
    valorPagado.closest("div.edit-view-row-item").show();
    valoresPagar.hide();
    addToValidate('EditView', 'valor_contrato_c', 'varchar', true, 'Valor Contrato');
    addToValidate('EditView', 'valor_pagado_c', 'varchar', true, 'Valor Pagado');
    //borrarTablaValores();
  }
}



function hideContactsDelayed() {
  setTimeout(function () {
    var addUser = document.getElementById('create-invitees');
    if (addUser) {
      addUser.style.display = 'none';
    }
  }, 500);
}


function ocultarDate() {
  var elementos = ['hora_entrada_c_trigger', 'hora_entrada_c_date']
  elementos.forEach(function (elemento) {
    var data = document.getElementById(elemento);
    data.style.display = 'none';
  });

}



