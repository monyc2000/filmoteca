if (typeof functions === 'undefined')
	functions = new Array();
functions.push(function() {

	$('#ItemShopCategoryId').on('change', function() {

		$('#items > div').hide().find('input,select,textarea').prop('disabled', true);
		$('.item' + $(this).val()).show().find('input,select,textarea').prop('disabled', false);
	}).trigger('change');

	$.extend($.validator.messages,
			{
				required: 'Este campo es requerido',
				number: 'Número invalido',
				digits: 'Sólo digitos.',
			}
	)
	$('#ItemAddForm').validate({
		rules: {
			'data[Item][precio_general]': {required: true, number: true},
			'data[Item][precio_especial]': {required: true, number: true},
			'data[Item][existencias]': {required: false, digits: true},
			'data[Film][título]': 'required',
			'data[Film][género]': 'required',
			'data[Film][director]': 'required',
			'data[Film][duración]': 'required',
			'data[Film][año]': 'required',
			'data[Book][título]': 'required',
			'data[Book][autor]': 'required',
			'data[Book][sinopsis]': 'required',
			'data[Souvenir][nombre]': 'required',
		},
		submitHandler: function(form) {
			if (form['ItemExistencias'].value === '') {
				form['ItemExistencias'].value = 0;
			}
			form.submit();
		}
	});

});

