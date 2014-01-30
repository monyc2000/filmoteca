if (typeof functions === 'undefined')
	functions = new Array();

functions.push(function() {

	var showAppliedFilters = function($selectedFilters, results) {
		var $a = $selectedFilters.first();
		var tmp = $('<a>', {
			href: "#",
		});

		tmp.data('filter', $a.data('filter'));
		tmp.html($a.html());
		$('#applied-filters').html(tmp);

		$('#results').html(results);
		if (results === 0)
			$('#without-results').show();
		else
			$('#without-results').hide();
	};

	$('#filters-menu').billboardWithFilters({
		showAppliedFilters: showAppliedFilters
	}).hideshowSubmenus();



//    $('#applied-filters').on('click', 'a', function() {
//        var filter = $(this).data('filter');
//        $('#filters-menu').billboardWithFilters('removeAll')
//        $('#filters-menu').billboardWithFilters('addFilter', filter);
//    });

	$('#items').find('a').fancybox({
		type: 'ajax',
		maxWidth: 900,
		minWidth: 250
	});
});

