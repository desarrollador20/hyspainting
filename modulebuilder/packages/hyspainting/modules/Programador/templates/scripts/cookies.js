function asignarPunto(item) {
	var val = $(item).val();
	createCookie('punto_recepcion', val, 24*3);
}

//Función para crear una cookie, con nombre, valor y horas de vencimiento
function createCookie(name,value,hours) {
	if (hours) {
		var date = new Date();
		date.setTime(date.getTime()+(hours*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
