if (typeof functions === 'undefined')
	functions = new Array();
functions.push(function() {

	var migajasFiltros = function($selectedFilters, results) {
		var $a = $selectedFilters.first();
		var tmp = $('<a>', {
			href: "#",
		});

		tmp.data('filter', $a.data('filter'));
		tmp.html($a.html());
		$('#applied-filters').append('&gt;').append(tmp);

		$('#results').html(results);
		if (results === 0)
			$('#without-results').show();
		else
			$('#without-results').hide();
	};

	 $('#filters-menu').billboardWithFilters({
		showAppliedFilters : migajasFiltros
	}).hideshowSubmenus();

	$('#items').find('a').fancybox({
		maxWidth: 900
	});


	/* Agrega artículos al carrito */
	$('#items').on('click', '.buy', function(event) {
		event.preventDefault();

		$.ajax({
			url: $(this).attr('href'),
			dataType: 'json',
			success: function(json) {
				var table = $('<table></table>');
				var total = 0;
				$.each(json, function() {
					var tr = $('<tr></tr>');
					var tmp = '';
					tmp += '<td>' + this.nombre + '</td> ';
					tmp += '<td>' + this.cantidad + ' x </td> ';
					tmp += '<td>' + (this.cantidad * this.precio_de_venta) + '</td> ';
					total += this.cantidad * this.precio_de_venta;
					tr.html(tmp);
					table.append(tr);
				});

				if (json.length !== 0)
					$('#cart').show();

				$('#cart').find('.shopping-list').html('').append(table);
				$('#cart').find('.total > span').html(total);
				$('#cart').children('.shopping').stop().show('fast');
				window.setTimeout(function() {
					$('#cart').children('.shopping').stop().hide('slow');
				}, 3000);
			}
		});
	});
	$('#cart').on('mouseenter', function() {
		$(this).children('.shopping').stop().show('fast');
	}).on('mouseleave', function() {
		$(this).children('.shopping').stop().hide('slow');
	});

	if ($('#cart').find('tr').length !== 0) {
		$('#cart').show();
	}
});