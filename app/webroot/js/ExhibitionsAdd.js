if (typeof functions === 'undefined')
	functions = new Array();
functions.push(function() {

	$('#ExhibitionFilmId').autocomplete({
		source: function(request, response) {
			$.ajax({
				url: $('#ExhibitionFilmId').data('json') + '/titulo:' + request.term,
				dataType: 'json',
				success: function(data) {
					response(data);
				}
			});
		}
	}).on('focusout keydown', function(event) {

		if (event.type === 'focusout' ||
				(event.type === 'keydown' &&
						event.which == 13)) {
			var val = $(this).val();
			var end = val.indexOf(')');
			$('#film_id').val(val.substring(1, end));
		}

	});

	var index = 1;

	$('#add-new-timetable').on('click', function() {
		var $month = $('#Timetable0FechaMonth').clone();
		var $day = $('#Timetable0FechaDay').clone();
		var $year = $('#Timetable0FechaYear').clone();
		var $hour = $('#Timetable0HoraHour').clone();
		var $min = $('#Timetable0HoraMin').clone();
		var $meridian = $('#Timetable0HoraMeridian').clone();

		var inputField = $('<div></div>', {"class": 'field-input'});
		var inputFieldHora = inputField.clone();
		var a = new Array('month', 'day', 'year');
		var $a = new Array($month, $day, $year);
		var b = new Array('hour', 'min', 'meridian');
		var $b = new Array($hour, $min, $meridian);

		inputField.append('<label>Fecha</label>', {"for": 'Timetable' + index + 'FechaMonth'})
		inputFieldHora.append('<label>Hora</label>', {"for": 'TimeTable' + index + 'HoraHour'});

		for (var i = 0; i < 3; i++) {
			$a[i].attr({
				id: 'Timetable' + index + 'fecha' + a[i],
				name: 'data[Timetable][' + index + '][fecha][' + a[i] + ']',
			}).appendTo(inputField);


			$b[i].attr({
				id: 'Timetable' + index + 'hora' + b[i],
				name: 'data[Timetable][' + index + '][hora][' + b[i] + ']',
			}).appendTo(inputFieldHora);
			if (i < 2) {
				inputField.append('-');
				inputFieldHora.append(':');
			}
		}

		var $last = $('#ExhibitionAddForm').find('.field-input:last');
		$last.after(inputFieldHora);
		$last.after(inputField);


	})
});