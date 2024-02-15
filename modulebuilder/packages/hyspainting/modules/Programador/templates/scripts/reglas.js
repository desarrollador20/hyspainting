
function addReglaItem(item) {
	var aux = $('.lista').find('tr.repositorio')[0];
	//Crear el clon del repositorio
	var clon = $(aux).clone();
	//Crear el número aleatorio con el que identificaremos el item
	var rand = Math.ceil(Math.random() * 899999 + 100000);
	//Aplicar el identificador en el clon del repositorio
	var html = clon.html().replace(/%rand%/g, rand);
	clon.html(html);
	//Agregar el repositorio al final de la tabla
	clon.appendTo($('.lista').find('tbody'));
	//Eliminar la clase repositorio del clon para permitir que se visualice.
	$(clon).removeClass('repositorio');

	//Asignar eventos
	setEvents(rand);

	$('#id_' + rand).val(item.id);
	$('#usuario_' + rand).val(item.name);
	$('#rol_' + rand).val(item.puesto);

	return rand;
}




function removeReglaItem(item) {
	const fila = item.closest('tr')
	const inputs = fila.querySelectorAll('input');
	const inputProyectoId = fila.querySelector('input[name^="proyecto_id_"]');
	const valorProyectoId = inputProyectoId.value;

	console.log(valorProyectoId);
	//Eliminar este item de la tabla
	if (item) {

		$(item).parents('tr')[0].remove();
		contador(valorProyectoId);
		return;
	}
	var filas = $('.lista').find('tr:not(.repositorio):not(:has(th))');

	// Elimina todas las filas encontradas
	filas.remove();

}


function contador(proyecto) {

	const originalContainer = document.getElementById(proyecto);

	totalUsuarios = countUser(proyecto);

	if (originalContainer) {
		// Busca el <span> dentro de la fila (tr)
		const totalUsuariosSpan = originalContainer.querySelector('td span');
		if (totalUsuariosSpan) {
			// Actualiza el contenido del <span> con el nuevo texto
			totalUsuariosSpan.textContent = 'Total de usuarios: ' + totalUsuarios.length;
		}
	}
}



function setEvents(rand) {
	// ... tu código existente ...

	// Dentro del evento de cambio del select
	$('select[name="puesto_' + rand + '"]').on('change', function () {
		var valorSeleccionado = $(this).val();
		valoresSeleccionados.push(valorSeleccionado);
		console.log('Valores seleccionados:', valoresSeleccionados);
		// Deshabilitar opción seleccionada en otros selects
		$('select[name^="puesto_"] option[value="' + valorSeleccionado + '"]').prop('disabled', true);
	});
}








function dialogo_user(id_user, name) {

	var modalElement = $("<div><img src='index.php?entryPoint=download&id=" + id_user + "_photo&type=Users' alt='Imagen' class='responsive-image'>").dialog({
		title: name,
		width: 363,
		close: function () {
			$(this).dialog("destroy"); // Destruir el modal cuando se cierra
		},
		buttons: {
		},
		create: function () {
			var miImagen = $(this).find('img')[0]; // Obtener directamente la referencia a la imagen
            miImagen.onload = function() {
                // La imagen se ha cargado correctamente
                // Verificar si la imagen contiene colores
                var contieneColor = verificaImagenEnColor(miImagen);
                if (!contieneColor) {
                    $(miImagen).replaceWith("<div>El usuario no tiene fotogrfía cargada</div>");
				}
            };
     
	
		}
	}); //end confirm dialog




}
function verificaImagenEnColor(imagen) {
    // Crear un elemento canvas
    var canvas = document.createElement('canvas');
    canvas.width = imagen.width;
    canvas.height = imagen.height;
    var contexto = canvas.getContext('2d');

    // Dibujar la imagen en el canvas
    contexto.drawImage(imagen, 0, 0);

    // Obtener los datos de píxeles de la imagen
    var imageData = contexto.getImageData(0, 0, canvas.width, canvas.height);
    var data = imageData.data;

    // Iterar a través de los datos de píxeles y verificar si alguno no es blanco o negro
    for (var i = 0; i < data.length; i += 4) {
        var r = data[i];
        var g = data[i + 1];
        var b = data[i + 2];

        // Si el píxel no es completamente blanco (255, 255, 255) ni completamente negro (0, 0, 0), considerarlo en color
        if (r !== 0 || g !== 0 || b !== 0) {
            return true; // La imagen contiene colores
        }
    }

    return false; // La imagen es en blanco y negro
}





