if (typeof functions === 'undefined')
    functions = new Array();

functions.push(function() {
    $('#FilmAddForm').validate({
        rules: {
            'data[Film][título]': 'required',
            'data[Film][género]': 'required',
			'data[Film][director]': 'required',
			'data[Film][duración]': {required: true, digits: true},
			'data[Film][año]': 'required',
			'data[Film][sinopsis]': 'required'
        },
        messages: {
            'data[Film][título]': 'Requerido.',
            'data[Film][género]': 'Requerido.',
			'data[Film][director]': 'Requerido.',
			'data[Film][duración]': 'Requerido y sólo números',
			'data[Film][año]': 'Requerido.',
			'data[Film][sinopsis]': 'Requerido.'
        }
    });
});