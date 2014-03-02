/**
 * Este script sólamente ejecutara las funciones que se haya agregado al arreglo
 * functions. Esto para solo llamar a la funcion ready  una únicamente una vez.
 */

$(document).ready(function() {
	if (typeof functions === 'undefined')
		functions = new Array();

	var l = functions.length;
	for (var i = 0; i < l; i++) {
		functions[i]();
	}
});