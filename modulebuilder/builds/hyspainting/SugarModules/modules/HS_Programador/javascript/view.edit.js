
/*
const project_id = document.getElementById("project_id_c");
var currentValue = project_id.value;
// Función para manejar cambios en el campo de proyecto
const handleProjectChange = function (mutationsList, observer) {
  for (const mutation of mutationsList) {
    if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
      const newValue = project_id.value;
      if (currentValue !== newValue) {

        currentValue = newValue; // Actualizar el valor actual
        console.log(currentValue);
        GetUserProyect(currentValue);
      }
    }
  }
};

// Crear un observador para monitorear cambios en el valor del campo de proyecto
const observer = new MutationObserver(handleProjectChange);

// Configurar las opciones para observar cambios en atributos
const observerOptions = {
  attributes: true,
  attributeFilter: ['value'],
};

// Comenzar a observar el campo de proyecto
observer.observe(project_id, observerOptions);






function GetUserProyect(code_proyecto) {
   const query = {
      action: 'getDuplicate',
      fecha: fecha
    }
  SUGAR.ajaxUI.showLoadingPanel();
  $.ajax({
    type: "POST",
    url: 'index.php?entryPoint=GetMethodsProgramadorEntryPoint',
    data: query,
    dataType: "json",
    error: function (jqXHR, textStatus, errorThrown) {
      console.error(textStatus, jqXHR, errorThrown)
    },
    success: function (data) {

      const results = data;
      removeReglaItem();
      if (results == null) {
        alert("Fallo el servicio. ¡Por favor intenta de nuevo!");
        return;
      }
      if (results?.length === 0) {
        alert("El proyecto no tiene recursos asociados");
        SUGAR.ajaxUI.hideLoadingPanel();
        return;
      }
      console.log(results.vinculados);
      drawPrerequisitos(results);
      console.log(results);
    }
  });
}

function drawPrerequisitos(data) {
  var datos = data.vinculados;

  for (const property in datos) {
    console.log(datos[property].id);
    addReglaItem(datos[property]);
  }
  if (data.no_vinculados?.length > 0) {
    addUser.style.display = 'block';

    var datos = data.no_vinculados;

    for (const property in datos) {

      console.log(datos[property].id);
    //  addReglaItem2(datos[property]);

    }

  }

  SUGAR.ajaxUI.hideLoadingPanel();

}
*/
/*
 function check_form(formname) {
  try {
    const aux = await getvalidate();
    console.log(aux);

    if (validate_form(formname, '')) {
      return true; // Retorna true si la validación es exitosa
    } else {
      return false; // Retorna false si la validación falla
    }
  } catch (error) {
    console.error("Error:", error);
    return false; // Maneja el error y retorna false
  }
}
*/
function getvalidate() {
  return new Promise((resolve, reject) => {
    const fecha = $('#fecha').val();
    const query = {
      action: 'getDuplicate',
      fecha: fecha
    };

    $.ajax({
      type: "POST",
      url: 'index.php?entryPoint=GetMethodsProgramadorEntryPoint',
      data: query,
      dataType: "json",
      success: function (data) {
        resolve(data); // Resuelve con los datos obtenidos de la llamada AJAX
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus, jqXHR, errorThrown);
        reject(errorThrown); // Rechaza en caso de error
      }
    });
  });
}



// Uso de la función getvalidate con promesas




