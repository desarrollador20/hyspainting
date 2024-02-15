var count = 1;
valores=[];
function addReglaItem(item) {

	searchPuesto();
	if (count > long_list) {
		return;

	}
	//Buscar la lista
	var lista = $(item).parents('.lista')[0];
	//Buscar el repositorio y extraer el elemento
	var aux = $(lista).find('tr.repositorio')[0];
	//Crear el clon del repositorio
	var clon = $(aux).clone();
	//Crear el número aleatorio con el que identificaremos el item
	var rand = Math.ceil(Math.random() * 899999 + 100000);
	//Aplicar el identificador en el clon del repositorio
	var html = clon.html().replace(/%rand%/g, rand);
	clon.html(html);
	//Agregar el repositorio al final de la tabla
	clon.appendTo($(lista).find('tbody'));
	//Eliminar la clase repositorio del clon para permitir que se visualice.
	$(clon).removeClass('repositorio');
	var data = $('input[name="regla[]"]');
	console.log(data[0].value);
	var nuevaSelect = clon.find('select[name^="puesto_"]');
   
    nuevaSelect.find('option').each(function() {
        var valor = $(this).val();
        if (valores.includes(valor)) {
            $(this).remove();
        }
    });

	//Asignar eventos
	setEvents(rand);
	count++;


	//Retornar el identificador de este nuevo item
	return rand;
}

function removeReglaItem(item) {
	//Eliminar este item de la tabla
	$(item).parents('tr')[0].remove();
	count--;
	searchPuesto();
}

function setEvents(rand) {


	$('select[name="puesto_' + rand + '"]').on('change', function () {
		searchPuesto();
	});


}

function setReglaQuickSearch(rand, campo) {

}

function validar() {
	console.log($('select[name^="puesto_"]'));

}

function searchPuesto() {
	var valoresSeleccionados = [];
	var opcionesPuesto = document.querySelectorAll('[name^="puesto_"]');

	$('select[name^="puesto_"] option').show();
	for (var i = 1; i < opcionesPuesto.length; i++) {
		var opcion = opcionesPuesto[i];
		if (opcion.tagName === 'SELECT' && opcion.options[opcion.selectedIndex].value !== '') {
			valoresSeleccionados.push(opcion.options[opcion.selectedIndex].value);
			valores=valoresSeleccionados;
			$('select[name^="puesto_"] option[value="' + opcionesPuesto[i].value + '"]').hide();

		}
	}

	console.log("Valores seleccionados:", valoresSeleccionados);

}

