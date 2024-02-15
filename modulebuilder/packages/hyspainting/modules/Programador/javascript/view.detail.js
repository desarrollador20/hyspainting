
document.addEventListener('DOMContentLoaded', function() {
  // Tu código JavaScript aquí
  // Puedes acceder a elementos del DOM y manipularlos de manera segura
  //addExcel();
});


function addExcel() {
  let id=$('[name="record"]').val();

  alert(id);

  
  $.ajax({
    data: {
      action: 'addExcel',
      proyecto: id
    },
    url: 'index.php?entryPoint=GetMethodsProgramadorEntryPoint',
    //type: 'POST',
    beforesend: function () {

    },
  }).always(function () {

  }).done(function (res) {
    console.log(res);
    // Descarga el archivo Excel
    var blob = new Blob([res], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
    var url = window.URL.createObjectURL(blob);
    var link = document.createElement("a");
    link.href = url;
    link.setAttribute("download", "departamento.xls");
    document.body.appendChild(link);
    link.click();
  }).fail(function () {
    alert('No se pudo relaizar la petición');
  });
 
  
 
  
}



// Uso de la función getvalidate con promesas




