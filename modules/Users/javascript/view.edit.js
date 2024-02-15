$(document).ready(function() {
    var fila = document.getElementById("email_options_link_type");
    fila.style.display = "none";
    var siguienteFila = fila.nextElementSibling;
      siguienteFila.style.display = "none";
    var fila = document.getElementById("editor_type");
    fila.style.display = "none";


    addToValidate('EditView', 'Users0emailAddress0', 'varchar', true, '');
  });










